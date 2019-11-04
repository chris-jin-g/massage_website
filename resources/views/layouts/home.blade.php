<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>    
	@include('layouts/include/head')
</head>
<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col= "2-columns">
    @include('layouts/include/header')    
    <!-- END: Header-->    
    <div class="app-content content">
        <div class="row">
            <div class="col-0"></div>
            <div class="col-12 wizard_panel">
                <div class="content-body">
                    <section id="number-tabs">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    @include('layouts/include/wizardHeader')
                                    @yield('wizard_content')
                                    <div class="col-12 move_step">
                                        <img src="{{asset('images/arrow.png')}}" class="pull-left first-step" onclick="first_step();">
                                        @if(Request::is('manage/*'))
                                        @else
                                        <button class="btn btn-primary next_step pull-right" onclick="next_step();">Next</button>
                                        @endif                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-0"></div>
            
        </div>

    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts/include/footer')    
    <!-- END: Footer-->
    
    <!-- BEGIN jquery and bootstrap -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- END jquery and bootstrap -->
    
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->
    
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('js/app-menu.js')}}"></script>
    <script src="{{asset('js/app_main.js')}}"></script>
    <!-- END: Theme JS-->
    
    <!-- BEGIN: Page JS-->
    <script src="{{asset('js/datatable-styling.js')}}"></script>    
    <!-- END: Page JS-->
    @if(Request::is('manage/*'))
        
        @if(Request::is('*/superadmin'))
            <script src="{{asset('js/main_superadmin.js')}}"></script>
        @else
            @if(Request::is('*/cashier'))
                <script src="{{asset('js/main_cashier.js')}}"></script>          
            @elseif(Request::is('*/admin'))
                <script src="{{asset('js/main_admin.js')}}"></script>
            @endif
            <script text="javascript">
                $(document).ready(function(){
                    $(".order_modify").click(function(event){
                        sel_order_num=$(".tr_active").attr("alt");
                        sel_order_id=$(".tr_active").attr("data-description");
                        if(sel_order_num==null){
                            event.preventDefault();
                        } else{
                            $(".current").removeClass("current");
                            $("fieldset:last-child").addClass("current");
                            orders={!! json_encode($orders) !!};
                            sel_order=orders[sel_order_num];
                            $("input[name='client_name']").val(sel_order['client_name']);
                            $("input[name='sel_staff']").val(sel_order['staff_name']);
                            $("input[name='sel_service']").val(sel_order['service_name']);
                            $("input[name='sel_room']").val(sel_order['room_id']);
                            $("input[name='refer_num']").val(sel_order['refer_num']);
                            $("input[name='duration']").val(sel_order['duration']);
                            $("input[name='total_time']").val(sel_order['total_time']);
                            $("#finish_state").val(sel_order['pay_status']);
                            sel_order_num++;
                            sel_remain_time=$("#DataTables_Table_2 tbody tr:nth-child("+sel_order_num+") td:nth-child(5)").html();
                            $("input[name='remain_time']").val(sel_remain_time);
                            // Change the form action Url
                            action_url=($("#modify_order").attr("action"));
                            pos=action_url.lastIndexOf("/");
                            res=action_url.substring(0,pos+1);
                            result=res.concat(sel_order_id);
                            $("#modify_order").attr("action",result);
                            resize_display();
                        }    
                    });
                });
            </script>
        @endif
        <script src="{{asset('js/manage.js')}}"></script>
        <script src="{{asset('js/jquery.table2excel.js')}}"></script>
        
    @else
        <script src="{{asset('js/nouislider.min.js')}}"></script> 
        <!-- <script src="{{asset('js/noui-slider.js')}}"></script>  -->
        <script src="{{asset('js/jquery.countdownTimer.js')}}"></script>       
        @if(session('sel_branch')==null)
            <script src="{{asset('js/main_choose.js')}}"></script>        
        @else
            <script src="{{asset('js/main_client.js')}}"></script>
        @endif
        
    @endif    
</body>
</html>