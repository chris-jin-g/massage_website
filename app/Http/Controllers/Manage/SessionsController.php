<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('noHttpCache');
    }
    public function index()
    {
        return view('pages.manage.sessions.create');
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $staff_id=$request['email'];
        $staff=DB::select("SELECT * FROM staff_infos WHERE staff_id='$staff_id' AND role!='0'");
        if ($staff && Hash::check($request['password'], $staff[0]->staff_pass)) {
            $vars = [
                "id"=>$staff[0]->id,
                "staff_id" => $staff_id,
                "staff_name" => $staff[0]->staff_name,
                "role" => $staff[0]->role,
                "branch_id" => $staff[0]->branch_id,
            ];            
            $request->session()->put('staff', $vars);      
            if(session('staff')['role']==1)
                return redirect()->to('manage/cashier');
            elseif(session('staff')['role']==2)
                return redirect()->to('manage/admin');
            elseif(session('staff')['role']==3)
                return redirect()->to('manage/superadmin');
        }else{
            return back()->withErrors([
                'message'=>'The email or password is incorrect, Please try again.'
            ]);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->session()->flush();
        return redirect()->to('manage/login');
    }
}
