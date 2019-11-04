@extends('layouts.home')
@section('wizard_content')
  <div class="card-content collapse show">
    <div class="card-body">       
          <!-- Step 1 -->
          @include('pages.manage.cashier.cashier_option')
          <!-- Step 2 -->
          @include('pages.manage.cashier.staff_info')
          <!-- Step 3 -->
          @include('pages.manage.cashier.room_info')          
          <!-- Step 4 -->
          @include('pages.manage.cashier.ongoing_order')            
          <!-- Step 5 -->
          @include('pages.manage.cashier.add_order')
          <!-- Step 6 -->
          @include('pages.manage.cashier.modify_order')
          <!-- Step 6 -->
          @include('pages.manage.cashier.qrcode')  
    </div>
  </div>
@endsection