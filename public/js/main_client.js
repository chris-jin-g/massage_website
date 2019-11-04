var timer2='';
$(document).ready(function(){
  var slider = document.getElementById('slider-step');
  noUiSlider.create(slider, {
      start: 3,
      connect: 'lower',
      step:1,
      range: {
          'min': 0,
          'max': 5
      }
  });
  slider.noUiSlider.on('update', function( values, handle ) {
      $("#service_duration").html(parseInt(values));
      $("#duration").val(parseInt(values));
  });
                
  var current_state=$("#current_state").val();
  if(current_state==1){
    $("fieldset:first-child").addClass("current");  
  }else if(current_state==2){
    $("fieldset:nth-child(5)").addClass("current");
    $(".move_step").css("z-index",-1);
    // $(".next_step").css("display","none");
  }
  else if(current_state==3){
    $("fieldset:nth-child(9)").addClass("current");
    $(".move_step").css("z-index",-1);
  }
  //First step of the wizard when page load 
  $(".first-step").css("display","none"); 
  $(".next_step").prop('disabled', true);
  // resize_current();
  disable_button();
  
  $(window).resize(function(){
    resize_roomImage();
    resize_staffImage();
    resize_display();
    // resize_current();
  });
  timer2 = $("#time_remain").html();
  if(timer2!=undefined){
    var interval = setInterval(function() {
      var timer = timer2.split(':');
      var hours = parseInt(timer[0],10);
      var minutes = parseInt(timer[1], 10);
      var seconds = parseInt(timer[2], 10);
      --seconds;
      minutes = (seconds < 0) ? --minutes : minutes;
      hours=(minutes<0)? --hours:hours;
      if (hours < 0) clearInterval(interval);
      seconds = (seconds < 0) ? 59 : seconds;
      minutes=( minutes<0 ) ?59 : minutes;
      seconds = (seconds < 10) ? '0' + seconds : seconds;
      minutes = (minutes <10 )? '0' + minutes :minutes;
      //minutes = (minutes < 10) ?  minutes : minutes;
      $('#time_remain').html(hours+':'+minutes + ':' + seconds);
      timer2 = hours+':'+minutes + ':' + seconds;
    }, 1000);
  }
  
  $(".room_img").click(function(){
    $(".room_img").css("border","none");
    $(this).css("border","3px solid #61bd61");
    $(".next_step").prop('disabled', false);
    $(".start_service").prop('disabled', false);
    $("#sel_room").val($(this).find("img").attr("alt"));
  });
  $(".user_avatar img").click(function(){
    $(".next_step").prop('disabled', false);
    $("#sel_staff").val($(this).attr("alt"));

  });
  $(".service_choose").click(function(){
    $(".next_step").prop('disabled', false);
    $("#sel_service").val($(this).attr("alt"));
  });
  $(".hvr-rectangle-out button").click(function(){
    $(".next_step").prop('disabled', false);
  }); 
  $(".add_service").click(function(){
    clearInterval(interval);
  });
  $(".check_out").click(function(){
    $(".current").removeClass("current");
    $("fieldset:nth-child(6)").addClass("current");
    $(".move_step").css("z-index",1);
    $(".next_step").css("display","block");
    $(".first-step").css("display","block");
    resize_display();
    calc_pay();
  });
  $(".start_service").click(function(e){
    e.preventDefault();
    start_service();
  });
  resize_display();
});

//====Adjust the height of the image to fit the browser size=====//
function resize_roomImage(){
  var room_img_heght=[];
  $(".massage_room").each(function(){
      room_img_heght.push($(this).find("img").height());
  });
  room_min_height = Math.min.apply(null,room_img_heght);
  $(".room_img").css("height",room_min_height);
}
function resize_staffImage(){
  staff_img_width=$(".rounded-circle").outerWidth();
  $(".rounded-circle").css("height", staff_img_width);
}
function resize_display(){
  body_height=$("body").outerHeight();
  wizard_panel_height=body_height-88;
  $(".wizard_panel").css("height",wizard_panel_height+"px");
  wizard_content_height=wizard_panel_height-255;
  $(".current>.row").css("height",wizard_content_height+"px");
}//=========The function when the prev or next button click=========//
function prev_step(){  
  var prev_item=$(".current").prev();
  $(".current").removeClass("current");
  prev_item.addClass("current"); 
  resize_display();
  disable_button();  
}
function next_step(){
  var current_index=$("fieldset").index($(".current"))+1;
  var fieldset_num=$("fieldset").length;
  var choose_staff=$(".number-tab-steps input[name='choose_staff']:checked").val();
  var pay_mode=$(".number-tab-steps input[name='pay_mode']:checked").val();
  last_submit_hide();
  start_submit_hide();
  next_item=$(".current").next();
  if(current_index==2 && choose_staff=="unchoose"){
    next_item=$(".current").next().next(); 
  }else if(current_index==2 && choose_staff=="choose"){
    next_item=$(".current").next();
  }
  if(current_index==6 && pay_mode=="pay_cashier"){
    next_item=$(".current").next().next();  
  }else if(current_index==6 && pay_mode=="ticket"){
    next_item=$(".current").next();
    last_submit_show();
  }
  if(current_index==3 || (current_index==2 && choose_staff=="unchoose") ){
    start_submit_show();
  } 
  if(current_index==5){
    calc_pay();
  }  
  $(".current").removeClass("current");
  next_item.addClass("current"); 
  $(".first-step").css("display","block"); 
  resize_display(); 
  disable_button();  
  // $(".next_step").prop('disabled', true);
}
//==== Decide to disable button when wizard is first step or last====//
function disable_button(){
  var fieldset_index=$("fieldset").index($(".current"))+1;
  var fieldset_num=$("fieldset").length;
  if(fieldset_index==2 || fieldset_index==6){
    $(".next_step").prop('disabled', false);
  }else{
    $(".next_step").prop('disabled', true);
  }
  if(fieldset_index==1 || fieldset_index==5 ){
    $(".first-step").css("display","none");
  }else{
    $(".first-step").css("display","block");
  }
  if(fieldset_index==1){
    $(".prev_step").prop('disabled', true);
  }else{
    $(".prev_step").prop('disabled', false);
  }
  if(fieldset_index==4){
    resize_roomImage();
  }
  if(fieldset_index==3){
    resize_staffImage();
  }
}
function first_step(){  
  var current_index=$("fieldset").index($(".current"))+1;
  $(".current").removeClass("current");
  if(current_index>1 && current_index<5){
    $("fieldset:first-child").addClass("current");    
    start_submit_hide();
  }
  else{
    $("fieldset:nth-child(5)").addClass("current");
    $(".move_step").css("z-index",-1);

    last_submit_hide();
  }
  resize_display();
  $(".first-step").css("display","none");
}
function last_submit_show(){
  $(".next_step").css("display","none");
  $(".last_submit").css("display","block");
}
function last_submit_hide(){
  // $(".next_step").css("display","block");
  $(".last_submit").css("display","none");
}
function start_submit_show(){
  $(".next_step").css("display","none");
  $(".start_service").css("display","block");
  $(".start_service").prop('disabled', true);
}
function start_submit_hide(){
  $(".next_step").css("display","block");
  $(".start_service").css("display","none");
}
function calc_pay(){
  var reserve_time=$("#reserve_duration").val();
  var remain_time = $("#time_remain").html();
  var reserve_sub_time = reserve_time.split(':');
  var remain_sub_time = remain_time.split(':');
  var rhours = parseInt(reserve_sub_time[0],10);
  var rminutes = parseInt(reserve_sub_time[1], 10);
  var rseconds = parseInt(reserve_sub_time[2], 10);
  var hours = parseInt(remain_sub_time[0],10);
  var minutes = parseInt(remain_sub_time[1], 10);
  var seconds = parseInt(remain_sub_time[2], 10);
  var proc_time=rhours*3600-hours*3600-minutes*60-seconds;
  var proc_hours=parseInt(proc_time/3600);
  proc_hours = (proc_hours < 10) ? '0' + proc_hours : proc_hours;
  var proc_minutes=parseInt((proc_time-proc_hours*3600)/60);
  proc_minutes = (proc_minutes < 10) ? '0' + proc_minutes : proc_minutes;
  var proc_seconds=parseInt(proc_time-proc_hours*3600-proc_minutes*60);
  proc_seconds = (proc_seconds < 10) ? '0' + proc_seconds : proc_seconds;

  $(".result h2").html("Total time: "+proc_hours+":"+proc_minutes+":"+proc_seconds);
  var total_pay=parseInt(proc_time*parseInt($("#price_per_hour").html())/3600);
  $(".total_pay").html("Total to Pay: "+total_pay+"$");
  $("#cost").val(total_pay);
  $("#total_time").val(proc_hours+":"+proc_minutes+":"+proc_seconds);
}
function start_service(){
  sel_staff=$("#sel_staff").val();
  sel_room=$("#sel_room").val();
  sel_service=$("#sel_service").val();
  duration=$("#duration").val();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
  });
  $.ajax({
    type:'get',
    url:'client/create',
    data:{sel_staff:sel_staff,sel_service:sel_service,sel_room:sel_room,duration:duration},
    success:function(data){
      if(data['success']==true){
        $("#current_state").val("2");
        $(".current").removeClass("current");
        $("fieldset:nth-child(5)").addClass("current");
        $(".move_step").css("z-index",-1);
        $(".first-step").css("display","none"); 
        $(".next_step").prop('disabled', true);
        $("#time_remain").html(data['duration']);
        timer2 = $("#time_remain").html();
        $("#reserve_duration").val(data['duration']);
        $("#price_per_hour").html(data['cost_per_hour']);
        var update_url=$("form.number-tab-steps").attr("action");
        var target_url=update_url.replace("/1","/"+data['order_id']);
        $("form.number-tab-steps").attr("action",target_url);
        start_submit_hide();
        disable_button();
        resize_display();
      }      
    }
  });
}