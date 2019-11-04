<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Staff_info;

class RegistrationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('noHttpCache');
    }
    public function index()
    {
        return view('pages.manage.registration.create');
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->validate(request(), [
            'staff_name' => 'required',
            'staff_id' => 'required|email',
            'staff_pass' => 'required'
        ]);
        $staffs = Staff_info::create([
            'staff_name' => $request['staff_name'],
            'staff_id' => $request['staff_id'],
            'staff_pass' => Hash::make($request['staff_pass']),
        ]);
        return redirect()->to('manage/login');
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
        //
    }
    public function destroy($id)
    {
        //
    }
}
