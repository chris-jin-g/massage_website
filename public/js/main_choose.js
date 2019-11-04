$(document).ready(function(){
  $(window).resize(function(){
    resize_choose_display();
  });
  $(".move_step").css("display","none")
  resize_choose_display();
});

function resize_choose_display(){
  body_height=$("body").outerHeight();
  wizard_panel_height=body_height-88;
  $(".wizard_panel").css("height",wizard_panel_height+"px");
  choose_branch_height=wizard_panel_height-145;
  $(".choose_branch").css("height",choose_branch_height+"px");
}//=========The function when the prev or next button click=========//
