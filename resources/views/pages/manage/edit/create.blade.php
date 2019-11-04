@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header register_header">{{ __('Edit Profile') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manage.edit',session('staff')['id'] ) }}">
                        {{ csrf_field() }}
                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6 position-relative has-icon-left">
                                <input id="name" type="text" class="form-control @error('staff_name') is-invalid @enderror" name="staff_name" value="{{ session('staff')['staff_name'] }}" required autocomplete="name" autofocus>

                                @error('staff_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6 position-relative has-icon-left">
                                <input id="password" type="password" class="form-control @error('staff_pass') is-invalid @enderror" name="staff_pass" required autocomplete="new-password">

                                @error('staff_pass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6 position-relative has-icon-left">
                                <input id="password-confirm" type="password" class="form-control @error('staff_confirm_pass') is-invalid @enderror" name="staff_confirm_pass" required autocomplete="new-password">
                                @error('staff_confirm_pass')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-control-position">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>                            
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary pull-right"><i class="ft-lock"></i>
                                    {{ __('Modify') }}
                                </button>
                            </div>
                        </div>             
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection