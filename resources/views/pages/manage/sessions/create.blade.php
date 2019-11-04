@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header login_header">{{ __('Login') }}</div>
                <div class="card-body manage_login">            
                    <form method="POST" action="/manage/login">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right label-control">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6 has-icon-left">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="star@outlook.com" required  autofocus>                                
                                @error('email')
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

                            <div class="col-md-6 has-icon-left">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">

                                @error('password')
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
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="ft-unlock"></i>
                                    {{ __('Login') }}
                                </button>                                
                            </div>
                        </div>
                        @foreach ($errors->all() as $error)
                          <div class="form-error">{{ $error }}</div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection