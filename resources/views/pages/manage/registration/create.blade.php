@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-10 col-sm-6 col-md-4 offset-1 offset-sm-3 offset-md-4">
            <h2>Register</h2>
            <form method="POST" action="/manage/register">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="staff_name" name="staff_name">
                </div>
         
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="staff_id" name="staff_id">
                </div>
         
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="staff_pass" name="staff_pass">
                </div>
         
                <div class="form-group">
                    <button style="cursor:pointer" type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
                <div class="form-group form-error">
                    <p>{{$errors->first('staff_name')}}</p>
                    <p>{{ $errors->first('staff_id') }}</p>
                    <p>{{ $errors->first('staff_pass') }}</p>
                </div>               
            </form>
        </div>
    </div>
 
@endsection