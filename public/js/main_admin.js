$(document).ready(function(){
  $(".card-body").css("padding","0px 20px 5px 20px");
  $("fieldset h2").css("height","37px");
  $("fieldset h2").css("margin","0px");
  admin_state=$("#admin_state").val();
  if(admin_state==1){
    $("fieldset:nth-child(2)").addClass("current");
    $(".first-step").css("display","block");
  }else if(admin_state==2){
    $("fieldset:nth-child(3)").addClass("current");
    $(".first-step").css("display","block");
  }else if(admin_state==3){
    $("fieldset:nth-child(9)").addClass("current");
    $(".first-step").css("display","block");
  }else if(admin_state==4){
    $("fieldset:nth-child(6)").addClass("current");
    $(".first-step").css("display","block");
  }else{
    $("fieldset:first-child").addClass("current");//First step of the wizard when page load  
    $(".first-step").css("display","none");    
  }
  


  $(".cashier_id").css("display","none"); //staff skill and avatar input
  $(".cashier_pass").css("display","none");
  $(".cashier_confirm_pass").css("display","none");
  $(".sel_skill").css("display","block");
  $(".sel_avatar").css("display","block");
  $(".cashier_pass").attr("required",false);
  $(".cashier_confirm_pass").attr("required",false);
  $(".staff_id").attr('required', false);
  $(".admin_option").click(function(){    
    var sel_index=$(this).attr("alt");
    sel_index++;
    $(".current").removeClass("current");
    $("fieldset:nth-child("+sel_index+")").addClass("current");
    $(".first-step").css("display","block");
  });
  $('.cashier_pass, .cashier_confirm_pass').on('keyup', function () {
    if ($('.cashier_pass').val() == $('.cashier_confirm_pass').val()) {
      $('#error_message').html('');
    } else 
      $('#error_message').html('Not Matching!').css('color', 'red');
  });
  $("#add_staff").submit(function(evt){  
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
      console.log(formData);
    $.ajax({
       url: 'fileUpload',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
         alert(response);
       }
    });
    return false;
  });
  $(".manage-btn").click(function(e){    
      btn_index=$(this).parent().find(".manage-btn").index($(this));
      page_index=$(this).parent().parent().find("fieldset").index($(this).parent());
      page_index++;      
      if(btn_index==0){
        $(".current").removeClass("current");
        if(page_index==2)
          $("fieldset:nth-child(10)").addClass("current");
        else if(page_index==3)
          $("fieldset:nth-child(12)").addClass("current");
        else if(page_index==4)
          $("fieldset:nth-child(14)").addClass("current");
        else if(page_index==6)
          $("fieldset:nth-child(16)").addClass("current");
        $(".first-step").css("display","block");
      }else if(btn_index==1){
        if($(".current table tbody tr").hasClass("tr_active")){
          $(".current").removeClass("current");
          if(page_index==2)
            $("fieldset:nth-child(11)").addClass("current");
          else if(page_index==3)
            $("fieldset:nth-child(13)").addClass("current");
          else if(page_index==4)
            $("fieldset:nth-child(15)").addClass("current");
          $(".first-step").css("display","block");
        }else{
          e.preventDefault();
        }
      }       
  });
  $('.sel_role').on('change', function () {
    select_role = $(this).val();
    disp_staff_type(select_role);    
  });
  $('.date_display select').change(function(){
    re_disp_salary();
  });
  $(".add_salary_btn").click(function(e){
    if($(".current input[name='bonus']").val()!=='' && $(".current input[name='note']").val()!=='' ){
      e.preventDefault();
      add_salary();
    }     
  });
  $(".modify_salary_btn").click(function(e){
    if($(".current input[name='bonus']").val()!=='' && $(".current input[name='note']").val()!=='' ){
      e.preventDefault();
      modify_salary();
    }
  });
  $(".reset_salary").click(function(){
    reset_salary();
  });
  $(window).resize(function(){
    resize_display();
  });
  resize_display();


  $(".dataTables_wrapper>.row:first-child>div ").removeClass("col-sm-12");
  $(".dataTables_wrapper>.row:first-child>div ").addClass("col-sm-6");
  $(".dataTables_wrapper>.row:first-child>div ").addClass("col-6");
  $(".pagination li:first-child a").html("<i class='fa fa-angle-double-left'></i>");
  $(".pagination li:last-child a").html("<i class='fa fa-angle-double-right'></i>");
//===============Set the option of the Salary======================//
  var get_y_m = new Date();
  var get_m = get_y_m.getMonth()+1;
  var get_y=get_y_m.getFullYear();
  if(get_m<10)
    get_m="0"+get_m;
  $("#sel_year").val(get_y);
  $("#sel_month").val(get_m);
});

//=========The function when the prev or next button click=========//
function first_step(){
  pg_index=$(".current").index();  
  if(pg_index==9 || pg_index==10){
    $(".current").removeClass("current");
    $("fieldset:nth-child(2)").addClass("current");
  }
  else if(pg_index==11 || pg_index==12){
    $(".current").removeClass("current");
    $("fieldset:nth-child(3)").addClass("current");
  }
  else if(pg_index==13 || pg_index==14){
    $(".current").removeClass("current");
    $("fieldset:nth-child(4)").addClass("current");
  }
  else if(pg_index==15){
    $(".current").removeClass("current");
    $("fieldset:nth-child(6)").addClass("current");
  }
  else{
    $(".current").removeClass("current");
    $("fieldset:first-child").addClass("current");
    $(".first-step").css("display","none");
  }
  

}
function set_modify_staff(){
  var sel_role=$(".current .tr_active td:nth-child(4)").attr("alt");
  var sel_skill=$(".current .tr_active td:nth-child(5)").attr("alt");
  $("fieldset:nth-child(11) .staff_name").val($(".current .tr_active td:nth-child(3)").html());  
  $("fieldset:nth-child(11) .sel_role").val(sel_role);  
  $("fieldset:nth-child(11) .sel_skill").val($(".current .tr_active td:nth-child(5)").attr("alt"));
  $("fieldset:nth-child(11) input[type='file']").attr("value",$(".current .tr_active td:nth-child(2) img").attr("src"));
  $("fieldset:nth-child(11) .staff_id").val($(".current .tr_active td:nth-child(6)").html());
  disp_staff_type(sel_role);
}
function set_modify_room(){
  $("fieldset:nth-child(13) input[name='room_name']").val($(".current .tr_active td:nth-child(3)").html());
  $("fieldset:nth-child(13) input[type='file']").attr("value",$(".current .tr_active td:nth-child(2) img").attr("src"));
}
function set_salary_staff(){
  $("fieldset:nth-child(14) #staff_name").val($(".current .tr_active td:nth-child(2)").html());
  $("fieldset:nth-child(14) #staff_id").val($(".current .tr_active").attr("data-description"));
  $("fieldset:nth-child(14) input[name='bonus']").val($(".current table tbody .tr_active td:nth-child(5)").html());
  $("fieldset:nth-child(14) input[name='note']").val("");
  $("fieldset:nth-child(15) #mstaff_name").val($(".current .tr_active td:nth-child(2)").html());
  $("fieldset:nth-child(15) #mstaff_id").val($(".current .tr_active").attr("data-description"));
  $("fieldset:nth-child(15) input[name='bonus']").val($(".current table tbody .tr_active td:nth-child(5)").html());
} $("fieldset:nth-child(15) input[name='note']").val("");
function disp_staff_type(select_role){
  if(select_role==0){
    $(".cashier_id").css("display","none");
    $(".sel_skill").css("display","block");
    $(".sel_avatar").css("display","block");
    $(".cashier_pass").css("display","none");
    $(".cashier_confirm_pass").css("display","none");
    $(".cashier_pass").attr("required",false);
    $(".cashier_confirm_pass").attr("required",false);
    $(".staff_id").attr('required', false);
  }else if(select_role==1){
    $(".cashier_id").css("display","block");
    $(".sel_skill").css("display","none");
    $(".sel_avatar").css("display","none");
    $(".cashier_pass").css("display","block");
    $(".cashier_confirm_pass").css("display","block");
    $(".cashier_pass").attr("required",true);
    $(".cashier_confirm_pass").attr("required",true);
    $(".staff_id").attr('required', true);
  }
}
function modify_action_url(){
  sel_order_id_0=$("#DataTables_Table_0 .tr_active").attr("data-description");
  action_url_0=$("#modify_staff").attr("action");
  pos_0=action_url_0.lastIndexOf("/");
  res_0=action_url_0.substring(0,pos_0+1);
  result_0=res_0.concat(sel_order_id_0);
  $("#modify_staff").attr("action",result_0);

  sel_order_id_1=$("#DataTables_Table_1 .tr_active").attr("data-description");
  action_url_1=$("#modify_room").attr("action");
  pos_1=action_url_1.lastIndexOf("/");
  res_1=action_url_1.substring(0,pos_1+1);
  result_1=res_1.concat(sel_order_id_1);
  $("#modify_room").attr("action",result_1);
}
function salary_btn_chech(){
  if($(".tr_active td:nth-child(5)").html()==""){
    $(".add_salary").prop('disabled', false);
    $(".modify_salary").prop('disabled', true);
  }else{
    $(".add_salary").prop('disabled', true);
    $(".modify_salary").prop('disabled', false);
  }
}
function tr_active(e){
  $("table tbody tr").removeClass("tr_active");
  $(e).addClass("tr_active");
  set_modify_staff();
  modify_action_url();
  set_salary_staff();
  salary_btn_chech();
  set_modify_room();
}
function resize_display(){
  body_height=$("body").outerHeight();
  wizard_panel_height=body_height-88;
  $(".wizard_panel").css("height",wizard_panel_height+"px");
  wizard_content_height=wizard_panel_height-185 ;
  $("fieldset>.row").css("height",wizard_content_height+"px");
  first_page_height=wizard_panel_height-115;
  $("fieldset:first-child>.row").css("height",first_page_height+"px");
}

function re_disp_salary(){
  get_year=$("#sel_year option:selected").val();
  get_month=$("#sel_month option:selected").val();
  get_full_month=get_year+"-"+get_month;
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
  });
  $.ajax({
       type:'GET',
       url:'/manage/admin/create',
       data:{get_full_month:get_full_month},
       success:function(data){
          var salary=data['salarys'];
          var salary_reload="";
          for (var i = 0; i < salary.length; i++) {
            if(salary[i]['sub_time']==null)
              sub_time="";
            else
              sub_time=salary[i]['sub_time'];
            if(salary[i]['total_cost']==null)
              total_cost="";
            else
              total_cost=salary[i]['total_cost'];
            if(salary[i]['bonus']==null)
              bonus="";
            else
              bonus=salary[i]['bonus'];
            var html=
              "<tr id="+salary[i]['id']+" alt="+(i+1)+" data-description="+salary[i]['id']+" onclick='tr_active(this);'>"+
              "<td>"+(i+1)+"</td>"+
              "<td>"+salary[i]['staff_name']+"</td>"+
              "<td>"+sub_time+"</td>"+
              "<td>"+total_cost+"</td>"+
              "<td>"+bonus+"</td>"+
              "</tr>"
            ;
            salary_reload+=html;
          }
          $(".salary_table tbody").html(salary_reload);
       }
    });
}
function add_salary(){
  var bonus=$(".current input[name='bonus']").val();
  var note=$(".current input[name='note']").val();
  var staff_id=$(".current input[name='staff_id']").val();
  var admin_flag=$(".current input[name='admin_flag']").val();
  var salary_type=$(".current input[name='salary_type']").val();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
  });
  $.ajax({
    type:'GET',
    url:'/manage/admin/create',
    data:{bonus:bonus, note:note,staff_id:staff_id,admin_flag:admin_flag,salary_type:salary_type},
    success:function(data){
      $(".current").removeClass("current");
      $("fieldset:nth-child(4)").addClass("current");
      re_disp_salary();
    }
  });
}
function modify_salary(){
  var bonus=$(".current input[name='bonus']").val();
  var note=$(".current input[name='note']").val();
  var staff_id=$(".current input[name='staff_id']").val();
  var admin_flag=$(".current input[name='admin_flag']").val();
  var salary_type=$(".current input[name='salary_type']").val();
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
  });
  $.ajax({
    type:'GET',
    url:'/manage/admin/create',
    data:{bonus:bonus, note:note,staff_id:staff_id,admin_flag:admin_flag,salary_type:salary_type},
    success:function(data){
      $(".current").removeClass("current");
      $("fieldset:nth-child(4)").addClass("current");
      re_disp_salary();
    }
  });
}
function reset_salary(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
  });
  $.ajax({
    type:'GET',
    url:'/manage/admin/create',
    data:{admin_flag:'salary_manage',salary_type:'reset_salary'},
    success:function(data){
      $(".current").removeClass("current");
      $("fieldset:nth-child(4)").addClass("current");
      re_disp_salary();
    }
  });
}