$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
  $("fieldset:first-child").addClass("current");//First step of the wizard when page load  
  $(".move_step").css("z-index","-1");
  $(".card-body").css("padding","0px 20px 5px 20px");
  $("fieldset h2").css("height","37px");
  $("fieldset h2").css("margin","0px");
  $(".cashier_opt").click(function(){
    var sel_index=$(".cashier_opt").parent().siblings().index($(this).parent());
    $(".current").removeClass("current");
    $("fieldset:nth-child("+(sel_index+2)+")").addClass("current");
    if(sel_index==4){
      $(".current").removeClass("current");
      $("fieldset:last-child").addClass("current");
    }
    $(".move_step").css("z-index","1");
    resize_display();
  }); 
  $(".import_to").click(function(e){    
    if($("#file-input").attr("value")==undefined){
      e.preventDefault();
    }
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
});

//=========The function when the prev or next button click=========//
function first_step(){  
  $(".current").removeClass("current");
  $("fieldset:first-child").addClass("current");
  $(".move_step").css("z-index","-1");
  resize_display();
}
// 
//==== Decide to disable button when wizard is first step or last====//
function disable_button(){
  var fieldset_index=$("fieldset").index($(".current"))+1;
  var fieldset_num=$("fieldset").length;
  if(fieldset_index==fieldset_num){
    $(".next_step").prop('disabled', true);
  }else{
    $(".next_step").prop('disabled', false);
  }
  if(fieldset_index==1){
    $(".prev_step").prop('disabled', true);
  }else{
    $(".prev_step").prop('disabled', false);
  }
  if(fieldset_index==4){
    resize_roomImage();
  }
}

function tr_active(e){
  $("table tbody tr").removeClass("tr_active");
  $(e).addClass("tr_active");
}
function resize_display(){
  body_height=$("body").outerHeight();
  wizard_panel_height=body_height-88;
  $(".wizard_panel").css("height",wizard_panel_height+"px");
  wizard_content_height=wizard_panel_height-185 ;
  $(".current>.row").css("height",wizard_content_height+"px");
}