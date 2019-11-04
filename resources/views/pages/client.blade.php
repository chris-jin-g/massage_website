@extends('layouts.home')
@section('wizard_content')
  <div class="card-content collapse show">     
    <div class="card-body">
         
        <form action="{{ route('client.update',1) }}" method="post" class="number-tab-steps">
          
          <!-- Step 1 -->
          @include('pages.client.choose_service')
          <!-- Step 2 -->
          @include('pages.client.staff_option')
          <!-- Step 3 -->
          @include('pages.client.choose_staff')          
          <!-- Step 4 -->
          @include('pages.client.choose_room')            
          <!-- Step 5 -->
          @include('pages.client.add_or_check')
          <!-- Step 6 -->
          @include('pages.client.pay_option')
          <!-- Step 7-->
          @include('pages.client.input_refernum')
           <!--Step 8 -->
          @include('pages.client.re_scan')
          <!-- Step 9 -->
          @include('pages.client.finish')
          <button type="submit" class="btn btn-info last_submit pull-right">Submit</button>
          <button type="submit" class="btn btn-info start_service pull-right">Start Service</button>
        </form>
    </div>
  </div>
@endsection