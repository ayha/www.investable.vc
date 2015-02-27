
$(document).ready(function(){
	$("#newsletter_form").submit(function(e){
		e.preventDefault();
		var email = $("#newsletter_form").find("input#newsletter_email").val();
		var url = $("#newsletter_form").attr("action");
		newsletter_signup_action(email, url);
		
	});
	
	$("a.send_msg_button").click(function(e){
        e.preventDefault();
         $("#send_message_form")[0].reset();
        $("#send_message_form #action_type").val("message");
        $("#send_message_form").attr("action", $("#send_message_form #msg_action_page").val());
        $("#send_message_form #recipient_id").val($(this).data("uid"));
        $("#send_message_form").show();
       
         $("#send_message_form").parent().children(".form_message").hide();
        $.fancybox.open({
		href:"#send_message_wrapper",
		modal: false,
		closeBtn: true
		});
    });
    
    $("a.connect_button").click(function(e){
        e.preventDefault();
        /*
         $("#send_message_form")[0].reset();
        $("#send_message_form #action_type").val("connect");
        $("#send_message_form").attr("action", $("#send_message_form #connect_action_page").val());
        $("#send_message_form #recipient_id").val($(this).data("uid"));
        $("#send_message_form").show();
         $("#send_message_form").parent().children(".form_message").hide();
        $.fancybox.open({
		href:"#send_message_wrapper",
		modal: false,
		closeBtn: true
		});
		*/
		
		var msg_url = $(this).data("url");
    	//console.log(url);
    	var msg_from = $("#send_message_form").children("input#sender_id").val();
    	var msg_to = $(this).data("uid");
    	var msg_subject  = "Please connect with me";
    	var msg = "Please connect with me";
    	var form = $(this).parent().parent();
    	var this_btn = $(this);
    	$.ajax(msg_url,
    		{
    			cache: false,
    			type: 'post',
    			data: {from: msg_from, to: msg_to, subject:msg_subject, message: msg},
    			complete: function(xhr, status){
    				 
    				if(status=="success" && xhr.responseText=="1"){  //success
    				   
    				  
    				  $("#send_message_form").hide();
    				  $("#send_message_form").parent().children(".form_message").show();
    				  this_btn.html("Request Sent");
    				  this_btn.attr("disabled", true);
    				  $.fancybox.open({
						href:"#send_message_wrapper",
						modal: false,
						closeBtn: true
						});
    				  
    				  
    				}else{
    				   alert("There was a problem sending the message. Please try again.");
    				}
    			
    			}
    		})    	
		
		
    });
    
    $("a.approve_connect_button").click(function(e){
    	e.preventDefault();
    	var url=$(this).data("url");;
    	var send_data = {"uid":$(this).data("uid")};
    	
    	$.ajax(url, {
    		   cache:false,
    		   type:"POST",
    		   data: send_data,
    		   complete: function(xhr,status){
    		   	  if(status == "success"){
    		   	  	window.location.reload();
    		   	  //	consolg.log(xhr);
    		   	  }
    		   }
    			
    		});
    });
    
    $(".message_table_row").click(function(e){
    	if($(this).data("msgid") != "" && $(this).data("hash") != ""){
    		var msg_url = $(this).parent().data("load-url")+"?msgid="+$(this).data("msgid")+"&hash="+$(this).data("hash");
    		$.ajax(msg_url, {
    		   cache:false,
    		   type:"GET",
    		   complete: function(xhr,status){
    		   	  if(status == "success"){
    		   	  	msg_content = xhr.responseText;
    		   	  	$.fancybox.open({
						content: msg_content,
						modal: false,
						closeBtn: true
					});
    		   	  }
    		   }
    			
    		});
    		
    		
    	}
    	
    });
    
    $(".connection_list").isotope({
			  itemSelector: '.connection_item',
			  layoutMode: 'fitRows',
			 
			});
			
	$(".company_grid").isotope({
			  itemSelector: '.company_grid_item',
			  layoutMode: 'fitRows',
			 
			});
    
    $("body").on("click",".msg_reply .reply_button", function(e){
    	e.preventDefault();
    	 $("#send_message_form")[0].reset();
    	var uid = $(this).parent().parent().data("sender-id");
    	var subject = "Re: " + $(this).parent().parent().children(".msg_subject").children(".row_content").html();
    	
    	 $("#send_message_form #recipient_id").val(uid);
    	 $("#send_message_form #msg_subject").val(subject);
         $("#send_message_form").show();
         $("#send_message_form").parent().children(".form_message").hide();
        $.fancybox.open({
		href:"#send_message_wrapper",
		modal: false,
		closeBtn: true
		});
    });
    
    $("#send_message_submit").on("click", function(e){
    	e.preventDefault();
    	
    	var msg_url = $(this).parent().parent().attr("action");
    	//console.log(url);
    	var msg_from = $(this).parent().parent().children("input#sender_id").val();
    	var msg_to = $(this).parent().parent().children("input#recipient_id").val();
    	var msg_subject  = $(this).parent().parent().find("#msg_subject").val();
    	var msg = $(this).parent().parent().find("#msg_message").val();
    	var form = $(this).parent().parent();
    	$.ajax(msg_url,
    		{
    			cache: false,
    			type: 'post',
    			data: {from: msg_from, to: msg_to, subject:msg_subject, message: msg},
    			complete: function(xhr, status){
    				 
    				if(status=="success" && xhr.responseText=="1"){  //success
    				   
    				  
    				  form.hide();
    				  form.parent().children(".form_message").show();
    				}else{
    				   alert("There was a problem sending the message. Please try again.");
    				}
    			
    			}
    		})    	
    });
    
    $("a.modal_link").click(function(e){
   				e.preventDefault();
   				var title = $(this).data("title");
   				var content = $(".modal_content " + $(this).data("content")).html();
   				
   				$("#event_modal h4#title-holder").html(title);
   				$("#event_modal #content-holder").html(content);
   				
   				$('#event_modal').modal({
					keyboard: false
				});
	
   	});
    
    $(".connection_item").on("click", ".member_thumbnail", function(e){
				e.preventDefault();
				//console.log($(this).parent().parent());
   				var title = $(this).parent().parent().data("displayname");
   				var content = $(".modal_content " + $(this).parent().parent().data("content")).html();
   				
   				$("#event_modal h4#title-holder").html(title);
   				$("#event_modal #content-holder").html(content);
   				
   				$('#event_modal').modal({
					keyboard: false
				});
				
	});
    
    $(".reward_badge a").click(function(e){
					e.preventDefault();
					
					rewards = $(this).children(".reward_content").html();
					$.fancybox.open(rewards);
				
				});
				
				$(".video_badge a.watch_video").fancybox({
					maxWidth	: 800,
					maxHeight	: 600,
					fitToView	: false,
					width		: '70%',
					height		: '70%',
					autoSize	: false,
					closeClick	: false,
					padding		: 0,
					openEffect	: 'none',
					closeEffect	: 'none'
				});
	
});


