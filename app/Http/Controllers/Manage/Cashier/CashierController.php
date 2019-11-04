<?php

namespace App\Http\Controllers\Manage\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DateTime;
use Excel;
use Carbon\Carbon;
use App\Order;

class CashierController extends Controller
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
        // staff sequence and room sequence initial
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
            SELECT staff_infos.id, staff_infos.staff_name, staff_infos.skill,staff_infos.online,orders.start_time,orders.last_time ,staff_infos.team_order
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
            SELECT orders.*, staff_infos.staff_name, room_infos.room_id, service_branches.service_name
            FROM orders 
            JOIN staff_infos ON orders.staff_id=staff_infos.id
            JOIN service_branches ON orders.ordered_service=service_branches.id
            JOIN room_infos ON orders.room_id=room_infos.id
            WHERE orders.pay_status=0 and orders.branch_id=".$branch_id." 
        ";
        $rooms=DB::select($sel_room_query);
        $staffs=DB::select($sel_staff_query);
        $orders=DB::select($sel_order_query);
        $services=DB::select('select *from service_branches');
        return view('pages.manage.cashier',['rooms'=>$rooms, 'staffs'=>$staffs, 'services'=>$services,'orders'=>$orders,'current_time'=>$current_time]);
    }

    public function create(Request $request)
    {
        $branch_id=session('staff')['branch_id'];
        if($request['modify_type']=='staff'){
            if($request['mark_order']=='mark'){
                DB::table('staff_infos')
                ->where('id', $request['staff_id'])
                ->update(['online'=>$request['online']]);
                return response()->json(['success' => true]); 
            }elseif($request['mark_order']=='order'){
                if($request['key']==1){
                    if($request['team_order']>1){
                        
                        DB::table('staff_infos')
                        ->where('branch_id', $branch_id)
                        ->where('team_order',$request['team_order']-1)
                        ->update(['team_order'=>$request['team_order']]);
                        DB::table('staff_infos')
                        ->where('branch_id', $branch_id)
                        ->where('id',$request['staff_id'])
                        ->update(['team_order'=>($request['team_order']-1)]);
                        return response()->json(['success' => true,'direction'=>'up']);
                    }else{
                        return response()->json(['success' => false]);
                    }
                }else if($request['key']==0){
                    if($request['team_order']<$request['max_order']){
                        DB::table('staff_infos')
                        ->where('branch_id', $branch_id)
                        ->where('team_order',$request['team_order']+1)
                        ->update(['team_order'=>($request['team_order'])]);
                        DB::table('staff_infos')
                        ->where('branch_id', $branch_id)
                        ->where('id',$request['staff_id'])
                        ->update(['team_order'=>($request['team_order']+1)]);
                        return response()->json(['success' => true,'direction'=>'down']);
                    }else{
                        return response()->json(['success' => false]);
                    }
                }
            }
        }elseif($request['modify_type']=='room'){
            if($request['mark_order']=='mark'){
                DB::table('room_infos')
                ->where('id', $request['room_id'])
                ->update(['used'=>$request['used']]);
                return response()->json(['success' => true]);
            }elseif($request['mark_order']=='order'){
                if($request['key']==1){
                    if($request['team_order']>1){
                        
                        DB::table('room_infos')
                        ->where('branch_id', $branch_id)
                        ->where('team_order',$request['team_order']-1)
                        ->update(['team_order'=>$request['team_order']]);
                        DB::table('room_infos')
                        ->where('branch_id', $branch_id)
                        ->where('id',$request['room_id'])
                        ->update(['team_order'=>($request['team_order']-1)]);
                        return response()->json(['success' => true,'direction'=>'up']);
                    }else{
                        return response()->json(['success' => false]);
                    }
                }else if($request['key']==0){
                    if($request['team_order']<$request['max_order']){
                        DB::table('room_infos')
                        ->where('branch_id', $branch_id)
                        ->where('team_order',$request['team_order']+1)
                        ->update(['team_order'=>($request['team_order'])]);
                        DB::table('room_infos')
                        ->where('branch_id', $branch_id)
                        ->where('id',$request['room_id'])
                        ->update(['team_order'=>($request['team_order']+1)]);
                        return response()->json(['success' => true,'direction'=>'down']);
                    }else{
                        return response()->json(['success' => false]);
                    }
                }
            }
            return response()->json(['success' => true]);
        }
        
        
    }

    public function store(Request $request)
    {
        if($request['file-upload']=='excel-upload'){
            $branch_id=session('staff')['branch_id'];
            $result = DB::select("SELECT NOW() AS mysql_time");
            $current_time=$result[0]->mysql_time;
            $create_current=date_create($current_time);
            $year_month=date_format($create_current,"Y-m");
            $filenameWithExt=$request->file('excel-upload')->getClientOriginalName();
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension=$request->file('excel-upload')->getClientOriginalExtension();
            $fileNameToStore=time().'.'.$extension;
            $file = $request->file('excel-upload');
            $file->move(base_path('\public\excel'), $fileNameToStore);
            $path=base_path('public\excel').'/'.$fileNameToStore;            
            $data = Excel::load($path)->get();
            if($data->count()){
                foreach ($data[0] as $key => $value) {
                    if($value->staff_name!=null)
                        $staff_id=DB::select("select *from staff_infos where staff_name='$value->staff_name'")[0]->id;
                    else 
                        $staff_id="";
                    if($value->Service_Name!=null)
                        $ordered_service=DB::select("select *from service_branches where service_name='$value->service_name'")[0]->id;
                    else
                        $ordered_service="";
                    if($value->room_id!=null)
                        $room_id=DB::select("select *from room_infos where room_id='$value->room_id'")[0]->id;
                    else
                        $room_id="";
                    if($value->paidyn=='y')
                        $paid=1;
                    else
                        $paid=0;
                    $client_name=$value->client_name;
                    $refer_num=$value->refer_num;
                    $cost=$value->cost;                    
                    $service_time=$value->service_time;
                    if($value->no!=null){
                        $staffs = Order::create([
                            'client_name' => $client_name,
                            'ordered_service' => $ordered_service,
                            'staff_id' => $staff_id,
                            'room_id'=> $room_id,
                            'total_time'=>$service_time,
                            'cost'=>$cost,
                            'start_time'=>$current_time,
                            'last_time'=>$current_time,
                            'duration'=>'03:00:00',
                            'branch_id'=>$branch_id,
                            'current_state'=>4,
                            'pay_status' => $paid,
                        ]);
                    }   
                }
            }
            if(session('staff')['role']==2){
                return redirect()->action('Manage\Admin\AdminController@index', ['admin_state' => 4]);
            }elseif(session('staff')['role']==1){
                return redirect()->to('manage/cashier');
            }   
        }else{
            if($request->hasFile('sel_avatar')){
                $filenameWithExt=$request->file('sel_avatar')->getClientOriginalName();
                $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
                $extension=$request->file('sel_avatar')->getClientOriginalExtension();
                $fileNameToStore=time().'.'.$extension;
                $file = $request->file('sel_avatar');
                $file->move(base_path('\public\images\avatar'), $fileNameToStore);
            }

            $branch_id=session('staff')['branch_id'];
            $duration=$request->input('sel_time');   
            $result = DB::select("SELECT NOW() AS mysql_time");
            $current_time=$result[0]->mysql_time; 
            $cost_per_hour=DB::select("SELECT * FROM service_branches WHERE id=".$request['sel_service'])[0]->price_per_hour;
            $estimate_cost=$cost_per_hour*$duration;  
            $date=date_create($current_time);
            $ex_duration=3600*$duration; 
            $ex_duration=date('H:i:s',$ex_duration);
            date_modify($date,"+".$duration." hours");
            $last_time=date_format($date,"Y-m-d H:i:s");
            $staffs = Order::create([
                'client_name' => $request['client_name'],
                'ordered_service' => $request['sel_service'],
                'staff_id' => $request['sel_staff'],
                'room_id'=> $request['sel_room'],
                'start_time' => $current_time,
                'duration' => $ex_duration,
                'last_time' => $last_time,
                'estimate_cost'=>$estimate_cost,
                'branch_id'=>$branch_id,
                'current_state'=>1,
                'pay_status' => 0,
            ]);
            if(session('staff')['role']==2){
                return redirect()->action('Manage\Admin\AdminController@index', ['admin_state' => 3]);
            }elseif(session('staff')['role']==1){
                return redirect()->to('manage/cashier');
            }
        }
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $total_time=$request->input('total_time');
        $refer_num=$request->input('refer_num');
        $finish_state=$request->input('finish_state');
            DB::table('orders')
            ->where('id', $id)
            ->update(['refer_num' => $refer_num, 'total_time'=>$total_time,'pay_status'=>$finish_state, ]);
        if(session('staff')['role']==2){
            return redirect()->action('Manage\Admin\AdminController@index', ['admin_state' => 4]);
        }elseif(session('staff')['role']==1){
            return redirect()->to('manage/cashier');
        }
    }

    public function destroy($id)
    {
        
    }
}
