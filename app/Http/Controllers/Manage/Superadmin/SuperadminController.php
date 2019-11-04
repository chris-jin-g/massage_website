<?php

namespace App\Http\Controllers\Manage\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Branch;
use App\Staff_info;

class SuperadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkstaff');
        $this->middleware('noHttpCache');
    }
    public function index()
    {
        $branches=DB::select('select * from branches');
        return view('pages.manage.superadmin',['branches'=>$branches]);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        Branch::create([
            'branch_name'=>$request['branch_name'],
        ]);
        $branch_id=DB::select("SELECT * FROM branches WHERE branch_name='".$request['branch_name']."'")[0]->id;
        Staff_info::create([
            'staff_id'=>$request['admin_name'],
            'staff_pass'=>Hash::make($request['admin_pass']),
            'branch_id'=>$branch_id,
            'role'=>2,
        ]);
        return redirect()->to('manage/superadmin');
    }

    public function show(Request $request,$id)
    {
        $vars = [
            "staff_id" =>session('staff')['staff_id'],
            "staff_name" => session('staff')['staff_name'],
            "role" => session('staff')['role'],
            "branch_id" => $id,
        ];            
        $request->session()->put('staff', $vars); 
        return redirect()->to('manage/admin');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}
