<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.manage.edit.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id=session('staff')['id'];
        $validateData=$request->validate([
            'staff_name'=>'required',   
            'staff_pass'=>'required|min:5',
            'staff_confirm_pass'=>'required|min:5',
        ]);
        DB::table('staff_infos')
                ->where('id', $id)
                ->update([
                    'staff_name'=>$request['staff_name'], 
                    'staff_pass'=>Hash::make($request['staff_pass']),
                ]);
        if(session('staff')['role']==1)
            return redirect()->to('manage/cashier');
        elseif(session('staff')['role']==2)
            return redirect()->to('manage/admin');
        elseif(session('staff')['role']==3)
            return redirect()->to('manage/superadmin');
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
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
    public function destroy($id)
    {
        //
    }
}
