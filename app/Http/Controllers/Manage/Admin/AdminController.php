<?php

namespace App\Http\Controllers\Manage\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Staff_info;
use App\Room_info;
use App\Bonus;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkstaff');
        $this->middleware('noHttpCache');
    }
    public function index()
    {
        $branch_id=session('staff')['branch_id'];
        $result = DB::select("SELECT NOW() AS mysql_time");
        $current_time=$result[0]->mysql_time;
        $create_current=date_create($current_time);
        $year_month=date_format($create_current,"Y-m");
        $admin_state = isset($_GET['admin_state']) ? $_GET['admin_state'] : 0;
        $staff_infos=DB::select("select *from staff_infos where role=0 and branch_id='$branch_id' ORDER BY team_order ASC");
        $room_infos=DB::select("select *from room_infos where branch_id='$branch_id' order by team_order ASC");
        for($i=0;$i<count($staff_infos);$i++){
            $id=$staff_infos[$i]->id;
            DB::table('staff_infos')
                ->where('id', $id)
                ->update(['team_order'=>($i+1)]);
        }
        for($j=0;$j<count($room_infos);$j++){
            $id=$room_infos[$j]->id;
            DB::table('room_infos')
                ->where('id', $id)
                ->update(['team_order'=>($j+1)]);
        } 
        $sel_staff_query="
            SELECT staff_infos.id, staff_infos.staff_name, staff_infos.skill,staff_infos.online,orders.start_time,orders.last_time,staff_infos.team_order 
            FROM staff_infos 
            left JOIN orders ON staff_infos.id = orders.staff_id and orders.last_time>'$current_time' 
            WHERE staff_infos.branch_id='$branch_id' AND staff_infos.role='0' 
            ORDER BY staff_infos.team_order
        ";
        $sel_room_query="
            SELECT room_infos.id, room_infos.room_id,orders.last_time, room_infos.used,room_infos.team_order
            FROM room_infos
            LEFT JOIN orders ON room_infos.id = orders.room_id AND orders.last_time>'$current_time' 
            WHERE room_infos.branch_id='$branch_id'
            ORDER BY room_infos.team_order 
        ";
        $sel_order_query="
            SELECT orders.*, staff_infos.`staff_name`, room_infos.`room_id`, service_branches.`service_name`
            FROM orders 
            JOIN staff_infos ON orders.`staff_id`=staff_infos.`id`
            JOIN service_branches ON orders.`ordered_service`=service_branches.`id`
            JOIN room_infos ON orders.`room_id`=room_infos.`id`
            WHERE orders.pay_status=0 and orders.branch_id='$branch_id'
        ";
        $achieve_orders_query="
            SELECT orders.*, staff_infos.`staff_name`, room_infos.`room_id`, service_branches.`service_name`
            FROM orders 
            LEFT JOIN staff_infos ON orders.`staff_id`=staff_infos.`id`
            LEFT JOIN service_branches ON orders.`ordered_service`=service_branches.`id`
            LEFT JOIN room_infos ON orders.`room_id`=room_infos.`id`
            WHERE orders.pay_status=1 and orders.branch_id='$branch_id'
        ";
        $salary_query="SELECT staff_infos.id, staff_infos.staff_name, sel_order.total_cost,sel_order.sub_time,sel_bonus.bonus
            FROM staff_infos
            LEFT JOIN (
                SELECT staff_id, SUM(cost) AS total_cost,CONCAT(CAST(FLOOR(SUM(TIME_TO_SEC(total_time)) / 3600)  AS CHAR ),'h ',CAST(FLOOR(SUM(TIME_TO_SEC(total_time)) % 3600/60)  AS CHAR ),'min') AS  sub_time
                FROM orders 
                WHERE branch_id='$branch_id' AND pay_status=1  AND (start_time like '$year_month%' AND last_time like '$year_month%')
                GROUP BY staff_id
                ) AS sel_order
            ON sel_order.staff_id =staff_infos.`id`
            LEFT JOIN (
                SELECT staff_id,bonus 
                FROM bonuses
                WHERE receive_time LIKE '$year_month%'
                ) AS sel_bonus 
            ON staff_infos.id=sel_bonus.staff_id
            WHERE branch_id='$branch_id' AND role=0";
        $rooms=DB::select($sel_room_query);
        $staffs=DB::select($sel_staff_query);
        $orders=DB::select($sel_order_query);
        $services=DB::select('select *from service_branches');
        $admin_menus=DB::select('select * from admin_menus');
        $staff_infos=DB::select("select * from staff_infos where branch_id=".$branch_id." order by role desc");
        $room_infos=DB::select("select * from room_infos where branch_id=".$branch_id." order by id");
        $achieve_orders=DB::select($achieve_orders_query);
        $salarys=DB::select($salary_query);
        return view('pages.manage.admin',['admin_menus'=>$admin_menus,'rooms'=>$rooms, 'staffs'=>$staffs, 'services'=>$services,'orders'=>$orders,'current_time'=>$current_time,'staff_infos'=>$staff_infos,'room_infos'=>$room_infos,'achieve_orders'=>$achieve_orders,'salarys'=>$salarys,'admin_state'=>$admin_state]);
    }
    public function create(Request $request)
    {       
        $branch_id=session('staff')['branch_id'];
        $result = DB::select("SELECT NOW() AS mysql_time");
        $current_time=$result[0]->mysql_time;
        if($request['admin_flag']=='salary_manage'){
            if($request['salary_type']=='add_salary'){
                Bonus::create([
                    'staff_id' => $request['staff_id'],
                    'bonus'=>$request['bonus'],
                    'note'=> $request['note'],
                    'receive_time'=>$current_time,
                    'branch_id'=>$branch_id,
                ]);
            }elseif($request['salary_type']=='modify_salary'){
                DB::table('bonuses')->where('staff_id', $request['staff_id'])->update([
                    'bonus'=>$request['bonus'],
                    'note'=> $request['note'],
                    'receive_time'=>$current_time,
                ]);
            }elseif($request['salary_type']=='reset_salary'){
                DB::table('bonuses')->where('branch_id',$branch_id)->delete();
            }

            return response()->json(['success' => true]);
        }else{
            $input = $request->all();
            $year_month=$input['get_full_month'];
            $salary_query="SELECT staff_infos.id, staff_infos.staff_name, sel_order.total_cost,sel_order.sub_time,sel_bonus.bonus
                FROM staff_infos
                LEFT JOIN (
                    SELECT staff_id, SUM(cost) AS total_cost,CONCAT(CAST(FLOOR(SUM(TIME_TO_SEC(total_time)) / 3600)  AS CHAR ),'h ',CAST(FLOOR(SUM(TIME_TO_SEC(total_time)) % 3600/60)  AS CHAR ),'min') AS  sub_time
                    FROM orders 
                    WHERE branch_id='$branch_id' AND pay_status=1  AND (start_time like '$year_month%' AND last_time like '$year_month%')
                    GROUP BY staff_id
                    ) AS sel_order
                ON sel_order.staff_id =staff_infos.`id`
                LEFT JOIN (
                    SELECT staff_id,bonus 
                    FROM bonuses
                    WHERE receive_time LIKE '$year_month%'
                    ) AS sel_bonus 
                ON staff_infos.id=sel_bonus.staff_id
                WHERE branch_id='$branch_id' AND role=0";
            $salarys=DB::select($salary_query);
            return response()->json(['success' => true, 'salarys' => $salarys]);
        }
        
    }

    public function store(Request $request)
    {
        $branch_id=session('staff')['branch_id'];
        if($request['admin_flag']=='staff_manage'){            
            if($request->hasFile('sel_avatar')){
                $filenameWithExt=$request->file('sel_avatar')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('sel_avatar')->getClientOriginalExtension();
                $fileNameToStore=time().'.'.$extension;
                $file = $request->file('sel_avatar');
                $file->move(base_path('\public\images\avatar'), $fileNameToStore);
            }
            else{
               $fileNameToStore='default-avatar.png';      
            } 
            $staffs = Staff_info::create([
                'staff_name' => $request['staff_name'],
                'role' => $request['sel_role'],
                'skill' => $request['sel_skill'],
                'staff_id'=> $request['staff_id'],
                'branch_id'=>$branch_id,
                'staff_pass' => Hash::make('123456789'),
                'staff_avatar'=> 'images/avatar/'.$fileNameToStore,
                'online'=>1,
            ]);  
            return redirect()->action('Manage\Admin\AdminController@index', ['admin_state' => 1]);  
        }else if($request['admin_flag']=='room_manage'){
            if($request->hasFile('room_img')){
                $filenameWithExt=$request->file('room_img')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('room_img')->getClientOriginalExtension();
                $fileNameToStore=time().'.'.$extension;
                $file = $request->file('room_img');
                $file->move(base_path('\public\images\massage_room'), $fileNameToStore);
            }
            else{
               $fileNameToStore='default.jpg';      
            } 
            $staffs = Room_info::create([
                'room_id' => $request['room_name'],
                'branch_id'=>$branch_id,
                'room_img'=> 'images/massage_room/'.$fileNameToStore,
                'used'=>1,
            ]);
            return redirect()->action('Manage\Admin\AdminController@index', ['admin_state' => 2]);
        }
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $branch_id=session('staff')['branch_id'];
        if($request['admin_flag']=='staff_manage'){   
            if($request->hasFile('sel_avatar')){
                $filenameWithExt=$request->file('sel_avatar')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('sel_avatar')->getClientOriginalExtension();
                $fileNameToStore=time().'.'.$extension;
                $file = $request->file('sel_avatar');
                $file->move(base_path('\public\images\avatar'), $fileNameToStore);
                DB::table('staff_infos')->where('id', $id)->update([
                    'staff_name' => $request['staff_name'],
                    'role' => $request['sel_role'],
                    'skill' => $request['sel_skill'],
                    'staff_id'=> $request['staff_id'],
                    'staff_pass' => Hash::make($request['cashier_pass']),
                    'staff_avatar'=> 'images/avatar/'.$fileNameToStore,
                ]);
            }
            else{
               // $fileNameToStore='noimage.jpg';
               DB::table('staff_infos')
                ->where('id', $id)
                ->update([
                    'staff_name' => $request['staff_name'],
                    'role' => $request['sel_role'],
                    'skill' => $request['sel_skill'],
                    'staff_id'=> $request['staff_id'],
                ]); 
            }
                
            return redirect()->action('Manage\Admin\AdminController@index', ['admin_state' => 1]); 
        }else if($request['admin_flag']=='room_manage'){
            if($request->hasFile('room_img')){
                $filenameWithExt=$request->file('room_img')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('room_img')->getClientOriginalExtension();
                $fileNameToStore=time().'.'.$extension;
                $file = $request->file('room_img');
                $file->move(base_path('\public\images\massage_room'), $fileNameToStore);
                DB::table('room_infos')
                ->where('id', $id)
                ->update([
                    'room_id' => $request['room_name'],
                    'room_img'=> 'images/massage_room/'.$fileNameToStore,
                ]);  
            }
            else{
               // $fileNameToStore='default.jpg';
                DB::table('room_infos')
                ->where('id', $id)
                ->update([
                    'room_id' => $request['room_name'],
                ]);  
            } 
            
            return redirect()->action('Manage\Admin\AdminController@index', ['admin_state' => 2]);      
        }        
        
    }
    public function destroy($id)
    {
        //
    }
}
