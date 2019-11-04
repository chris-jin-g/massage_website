@extends('layouts.home')
@section('wizard_content')
  <div class="card-content collapse show">
    <div class="card-body">
    	<!-- Step 1 -->
    	@include('pages.manage.admin.admin_option')
    	<!-- Step 2 -->
    	@include('pages.manage.admin.staff_manage')
    	<!-- Step 3 -->
        @include('pages.manage.admin.room_manage')
        <!-- Step 4 -->
    	@include('pages.manage.admin.salary')
    	<!-- Step 5 -->
    	@include('pages.manage.admin.achieve_orders')
    	<!-- Step 6 -->
    	@include('pages.manage.cashier.ongoing_order')
    	<!-- Step 7 -->
    	@include('pages.manage.cashier.staff_info')
    	<!-- Step 8 -->
    	@include('pages.manage.cashier.room_info')
    	<!-- Step 9 -->
    	@include('pages.manage.cashier.add_order')
    	<!-- Step 10 -->
        @include('pages.manage.admin.add_staff')
        <!-- Step 11 -->
        @include('pages.manage.admin.modify_staff')
        <!-- Step 12 -->
        @include('pages.manage.admin.add_room')
        <!-- Step 13 -->
        @include('pages.manage.admin.modify_room')
        <!-- Step 14 -->
        @include('pages.manage.admin.add_salary')
        <!-- Step 15 -->
        @include('pages.manage.admin.modify_salary')
        <!-- Step 16 -->
    	@include('pages.manage.cashier.modify_order')
    </div>
  </div>
@endsection