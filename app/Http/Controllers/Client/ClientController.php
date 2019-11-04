<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input as input;
use App\Order;
use Socialite;
use Auth;
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('noHttpCache');
    }

    public function redirectToProvider()
    {
        return Socialize::with('wechat_web')->redirect();
    }

    public function index(Request $request)
    {
        if(session('sel_branch')==null){
            return ("Your request is not correct.Please try to scan QR code again.");
        }else{
            $branch_id=session('sel_branch');
            $rooms=DB::select("select * from room_infos where branch_id='$branch_id' and used=1");
            $staffs=DB::select("select * from staff_infos where branch_id='$branch_id' and role='0' and online='1' order by skill desc");
            $services=DB::select('select *from service_branches');
            $user_email=auth()->user()->email;
            $user_phone=auth()->user()->phone;
            $orders=DB::select("SELECT * FROM orders WHERE client_name='$user_phone' AND pay_status='0'"); 
            $price_per_hour=DB::select("SELECT service_branches.price_per_hour FROM orders LEFT JOIN service_branches ON orders.ordered_service=service_branches.id WHERE orders.client_name='$user_phone' AND orders.pay_status='0' ");
            if(count($orders)==0){
                return view('pages.client',['rooms'=>$rooms, 'staffs'=>$staffs, 'services'=>$services]);
            }else{
                $last_time=$orders[0]->last_time;   
                $result = DB::select("SELECT NOW() AS mysql_time");
                $current_time=$result[0]->mysql_time;
                $date1=date_create($current_time);
                $date2=date_create($last_time);
                $diff=date_diff($date1,$date2);
                $remain_time=$diff->format('%H:%i:%s');
                return view('pages.client',['rooms'=>$rooms, 'staffs'=>$staffs, 'services'=>$services, 'orders'=>$orders,'remain_time'=>$remain_time,'current_time'=>$current_time,'price_per_hour'=>$price_per_hour]);
            }
        }
    }

    public function create(Request $request)
    {
        $sel_staff=$request->input('sel_staff');
        $sel_room=$request->input('sel_room');
        $sel_service=$request->input('sel_service');        
        $duration=$request->input('duration');       
        $user_email=auth()->user()->email;
        $user_phone=auth()->user()->phone;
        $result = DB::select("SELECT NOW() AS mysql_time");
        $current_time=$result[0]->mysql_time;       
        $date=date_create($current_time);
        $ex_duration=3600*$duration; 
        $ex_duration=date('H:i:s',$ex_duration);
        date_modify($date,"+".$duration." hours");
        $last_time=date_format($date,"Y-m-d H:i:s");
        $cost_per_hour=DB::select("SELECT * FROM service_branches WHERE id=".$request['sel_service'])[0]->price_per_hour;
        $estimate_cost=$cost_per_hour*$duration;
        DB::table('orders')->insert([
            'client_name' => $user_phone, 
            'staff_id' => $sel_staff,
            'ordered_service'=>$sel_service, 
            'room_id' => $sel_room,
            'start_time' => $current_time,
            'last_time' => $last_time,
            'duration' => $ex_duration,
            'estimate_cost'=>$estimate_cost,
            'pay_status' => 0,
            'current_state'=>2,
            'branch_id'=>session('sel_branch'),
        ]);
        $user_phone=auth()->user()->phone;
        $order_id=DB::select("SELECT * FROM orders WHERE client_name='$user_phone' AND pay_status='0'")[0]->id; 
        return response()->json(['success' =>true, 'duration'=>$ex_duration,'cost_per_hour'=>$cost_per_hour,'order_id'=>$order_id]);
    }
    //delete the store method(because ajax is used as create method)
    public function store(Request $request)
    {
        $sel_staff=$request->input('sel_staff');
        $sel_room=$request->input('sel_room');
        $sel_service=$request->input('sel_service'); 
        $duration=$request->input('duration');       
        $user_email=auth()->user()->email;
        $user_phone=auth()->user()->phone;
        $result = DB::select("SELECT NOW() AS mysql_time");
        $current_time=$result[0]->mysql_time;       
        $date=date_create($current_time);
        $ex_duration=3600*$duration; 
        $ex_duration=date('H:i:s',$ex_duration);
        date_modify($date,"+".$duration." hours");
        $last_time=date_format($date,"Y-m-d H:i:s");
        $cost_per_hour=DB::select("SELECT * FROM service_branches WHERE id=".$request['sel_service'])[0]->price_per_hour;
        $estimate_cost=$cost_per_hour*$duration;
        DB::table('orders')->insert([
            'client_name' => $user_phone, 
            'staff_id' => $sel_staff,
            'ordered_service'=>$sel_service, 
            'room_id' => $sel_room,
            'start_time' => $current_time,
            'last_time' => $last_time,
            'duration' => $ex_duration,
            'estimate_cost'=>$estimate_cost,
            'pay_status' => 0,
            'current_state'=>2,
        ]);
         return redirect('/client')->with('success', 'Book is successfully saved');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $cost=$request->input('cost');
        $total_time=$request->input('total_time');
        $refer_num=$request->input('refer_num');
        DB::table('orders')
            ->where('id', $id)
            ->update(['refer_num' => $refer_num, 'cost'=>$cost, 'total_time'=>$total_time, 'current_state'=>3]);
        return redirect()->route('client.index');
    }

    public function destroy($id)
    {
        //
    }
}
