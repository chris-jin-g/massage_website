$(document).ready(function(){
  $("fieldset:first-child").addClass("current");//First step of the wizard when page load  
  $(".move_step").css("z-index","-1");
  $(".card-body").css("padding","0px 20px 5px 20px");
  $("fieldset h2").css("height","37px");
  $("fieldset h2").css("margin","0px");
  $(".add_branch").click(function(){
    $(".current").removeClass("current");
    $("fieldset:last-child").addClass("current");
    $(".move_step").css("z-index","1");
  });
  $('#admin_pass, #confirm_admin_pass').on('keyup', function () {
    if ($('#admin_pass').val() == $('#confirm_admin_pass').val()) {
      $('#error_message').html('');
    } else 
      $('#error_message').html('Not Matching!').css('color', 'red');
  });
  $("#add_branch").click(function(event){
    if ($('#admin_pass').val() != $('#confirm_admin_pass').val()){
      event.preventDefault(); 
    }
  });
  $(".to_branch").click(function(){
    action_url=$(".choose_branch form").attr("action");
    sel_order_id=$(this).attr("alt");
    pos=action_url.lastIndexOf("/");
    res=action_url.substring(0,pos+1);
    result=res.concat(sel_order_id);
    $(".choose_branch form").attr("action",result);
  });
  $(window).resize(function(){
    resize_display();
  });
  resize_display();
});

//=========The function when the prev or next button click=========//
function first_step(){  
  $(".current").removeClass("current");
  $("fieldset:first-child").addClass("current");
  $(".move_step").css("z-index","-1");
}
function resize_display(){
  body_height=$("body").outerHeight();
  wizard_panel_height=body_height-88;
  $(".wizard_panel").css("height",wizard_panel_height+"px");
  wizard_content_height=wizard_panel_height-185 ;
  $("fieldset>.row").css("height",wizard_content_height+"px");
  // first_page_height=wizard_panel_height-115;
  // $("fieldset:first-child>.row").css("height",first_page_height+"px");
}