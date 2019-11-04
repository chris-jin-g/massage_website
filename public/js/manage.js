$(document).ready(function(){
  $(".up_down").click(function(){
  	$(".up_down").removeClass("active_updown");
  	$(this).addClass("active_updown");
  });
  $(".export_to").click(function(){
	$("#DataTables_Table_4").table2excel({
	    // exclude CSS class
	    exclude:".noExl",
	    name:"Worksheet Name",
	    filename:"SomeFile",//do not include extension
	    fileext:".xls" // file extension
	});
  });
});

function staff_check(e){
	if($(e).prop("checked")==true)
		online=1;
	else if($(e).prop("checked")==false)
		online=0;
	staff_id=$(".tr_active").attr("data-description");
	available_img=$("#available_img").val();
	unavailable_img=$("#unavailable_img").val();
	time_img=$("#time_img").val();
	wait_img=$("#wait_img").val();
	avail=$(".tr_active td:nth-child(4)").attr("available");
	busy=$(".tr_active td:nth-child(5)").attr("busy");
	remain=$(".tr_active td:nth-child(5)").attr("remain");
	$.ajaxSetup({
	  	headers: {
	      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	  	}
	});
	$.ajax({
		type:'GET',
		url:'/manage/cashier/create',
		data:{modify_type:'staff',mark_order:'mark',staff_id:staff_id,online:online},
		success:function(data){
			if(data['success']){
				if(online==1){
					if(avail==1){
						$(".tr_active td:nth-child(4)").html("<img class='staff_state' src='"+available_img+"'>");						
					}
					if(busy==1){
						$(".tr_active td:nth-child(5)").html("<img class='staff_state' src='"+wait_img+"'>");
					}else if(busy==0){
						$(".tr_active td:nth-child(5)").html("<img class='staff_state' src='"+time_img+"'>"+remain);
					}
				}else if(online==0){
					$(".tr_active td:nth-child(5)").html("");
					$(".tr_active td:nth-child(4)").html("<img class='staff_state' src='"+unavailable_img+"'>");
				}
			}
		}
	});
}
function room_check(e){
	if($(e).prop("checked")==true)
		used=1;
	else if($(e).prop("checked")==false)
		used=0;
	room_id=$(".tr_active").attr("data-description");
	available_img=$("#available_img").val();
	unavailable_img=$("#unavailable_img").val();
	time_img=$("#time_img").val();
	wait_img=$("#wait_img").val();
	avail=$(".tr_active td:nth-child(3)").attr("available");
	busy=$(".tr_active td:nth-child(4)").attr("busy");
	remain=$(".tr_active td:nth-child(4)").attr("remain");
	$.ajaxSetup({
	  	headers: {
	      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	  	}
	});
	$.ajax({
		type:'GET',
		url:'/manage/cashier/create',
		data:{modify_type:'room',mark_order:'mark',room_id:room_id,used:used},
		success:function(data){
			if(data['success']){
				if(used==1){
					if(avail==1){
						$(".tr_active td:nth-child(3)").html("<img class='staff_state' src='"+available_img+"'>");						
					}
					if(busy==1){
						$(".tr_active td:nth-child(4)").html("<img class='staff_state' src='"+wait_img+"'>");
					}else if(busy==0){
						$(".tr_active td:nth-child(4)").html("<img class='staff_state' src='"+time_img+"'>"+remain);
					}
				}else if(used==0){
					$(".tr_active td:nth-child(4)").html("");
					$(".tr_active td:nth-child(3)").html("<img class='staff_state' src='"+unavailable_img+"'>");
				}
			}
		}
	});
}
function updown_order(key){
	if($(".current").attr("alt")=="staff_info"){
		staff_id=$(".tr_active").attr("data-description");
		team_order=$(".tr_active").attr("tid");
		// max_order=$(".current table tbody tr:last-child").attr("id");
		max_order=$(".current table tbody tr:last-child td:first-child").html();
		$.ajaxSetup({
		  	headers: {
		      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		  	}
		});
		$.ajax({
			type:'GET',
			url:'/manage/cashier/create',
			data:{modify_type:'staff',mark_order:'order',staff_id:staff_id,team_order:team_order,max_order:max_order,key:key},
			success:function(data){
				if(data['success']==true){
					if(data['direction']=='up'){
						current=$(".tr_active").html();
						before=$(".tr_active").prev().html();
						td_id=$(".tr_active td:first-child").html();
						$(".tr_active").prev().before($(".tr_active"));
						if(td_id>1){
							$(".tr_active td:first-child").html(td_id-1);
							$(".tr_active").next().find("td:first-child").html(td_id);
							$(".tr_active").attr("tid",team_order-1);
							$(".tr_active").next().attr("tid",team_order);
						}				

					}else if(data['direction']=='down'){
						td_id=parseInt($(".tr_active td:first-child").html());
						$(".tr_active").next().after($(".tr_active"));
						if(td_id<max_order){
							$(".tr_active td:first-child").html(td_id+1);
							$(".tr_active").prev().find("td:first-child").html(td_id);
							$(".tr_active").attr("tid",parseInt(team_order)+1);
							$(".tr_active").prev().attr("tid",team_order);
						}
						
					}
				}
			}
		});
	}else if($(".current").attr("alt")=="room_info"){
		room_id=$(".tr_active").attr("data-description");
		team_order=$(".tr_active").attr("tid");
		// max_order=$(".current table tbody tr:last-child").attr("id");
		max_order=$(".current table tbody tr:last-child td:first-child").html();
		$.ajaxSetup({
		  	headers: {
		      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		  	}
		});
		$.ajax({
			type:'GET',
			url:'/manage/cashier/create',
			data:{modify_type:'room',mark_order:'order',room_id:room_id,team_order:team_order,max_order:max_order,key:key},
			success:function(data){
				if(data['success']==true){
					if(data['direction']=='up'){
						current=$(".tr_active").html();
						before=$(".tr_active").prev().html();
						td_id=$(".tr_active td:first-child").html();
						$(".tr_active").prev().before($(".tr_active"));
						if(td_id>1){
							$(".tr_active td:first-child").html(td_id-1);
							$(".tr_active").next().find("td:first-child").html(td_id);
							$(".tr_active").attr("tid",team_order-1);
							$(".tr_active").next().attr("tid",team_order);
						}

					}else if(data['direction']=='down'){
						td_id=parseInt($(".tr_active td:first-child").html())+1;
						$(".tr_active").next().after($(".tr_active"));
						if(td_id<max_order){
							$(".tr_active td:first-child").html(td_id);
							$(".tr_active").prev().find("td:first-child").html(td_id-1);
							$(".tr_active").attr("tid",parseInt(team_order)+1);
							$(".tr_active").prev().attr("tid",team_order);
						}
					}
				}
			}
		});
	}
}
