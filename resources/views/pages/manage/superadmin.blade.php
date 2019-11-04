@extends('layouts.home')
@section('wizard_content')
  <div class="card-content collapse show">
    <div class="card-body">
    	<!-- Step 1   -->
        @include('pages.manage.superadmin.choose')
          <!-- Step 2 -->
        @include('pages.manage.superadmin.addbranch')  
    </div>
  </div>
@endsection