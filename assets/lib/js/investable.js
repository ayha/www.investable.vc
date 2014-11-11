$(document).ready(function(){
	
	/* main nav animation */
	$(".navbar-nav>li>a").click(function(e){
		if($("#home_content").length ==1){
		e.preventDefault();
		var alias = $(this).data("alias");
		scrollToSection(alias);
		$(".navbar-collapse.in").removeClass("in");
		
		
		}
	});
	
	$(".home_news_row").click(function(e){
		var url = $(this).data("url");
		window.location.href=url;
		
	});
	
	$(".faq_item").click(function(e){
		$(this).toggleClass("active");
	});
	/*
	$(".navbar-signin a#join-us").click(function(e){
		e.preventDefault();
		$.fancybox.open({
			href:"#register_form_wrapper",
			modal: false,
			closeBtn:true
			
			 
		});
		
	});*/
	
	$(".navbar-signin a#login").click(function(e){
		e.preventDefault();
		$.fancybox.open({
			href:"#login_form_wrapper",
			modal: false,
			closeBtn:true
			
			
		});
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
		
		var msg_url = $("#send_message_form #connect_action_page").val();
    	//console.log(url);
    	var msg_from = $("#send_message_form").children("input#sender_id").val();
    	var msg_to = $(this).data("uid");
    	var msg_subject  = "Please connect with me";
    	var msg = "Please connect with me";
    	var form = $(this).parent().parent();
    	$.ajax(msg_url,
    		{
    			cache: false,
    			type: 'post',
    			data: {from: msg_from, to: msg_to, subject:msg_subject, message: msg},
    			complete: function(xhr, status){
    				 
    				if(status=="success" && xhr.responseText=="1"){  //success
    				   
    				  
    				  $("#send_message_form").hide();
    				  $("#send_message_form").parent().children(".form_message").show();
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
    	var url=$(this).parent().parent().parent().data("url");
    	var send_data = {"requestid":$(this).data("rid"), "hash":$(this).data("hash")};
    	
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
    
    $(".member_tools a.tool_button").each(function(){
    	
    	$(this).qtip({ // Grab some elements to apply the tooltip to
	    	content: {
	        	text: $(this).attr("title")
	    	},
   			 position: {
		        my: 'top center',  // Position my top left...
		        at: 'bottom center', // at the bottom right of...
		       
		    },
		    style: {
       			classes: 'qtip-dark qtip-shadow'
    		}
	    	
		});
	});
	
	$(".reward_badge").each(function(){
		$(this).qtip({ // Grab some elements to apply the tooltip to
	    	content: {
	        	text: $(this).children(".reward_content").html()
	    	},
   			 position: {
		        my: 'bottom left',  // Position my top left...
		        at: 'left center', // at the bottom right of...
		       
		    },
		    style: {
       			classes: 'qtip-light qtip-shadow'
    		}
	    	
		});
	});
	
	$("a.login_with_linkedin").click(function(e){
		e.preventDefault();
		// IN.Event.on(IN, "auth", onLinkedInAuth);
		IN.User.authorize(onLinkedInAuth);
	});
	
	
	$("input#newsletter_submit").click(function(e){
		e.preventDefault();
		var email = $("#newsletter_form").find("input#newsletter_email").val();
		var url = $("#newsletter_form").attr("action");
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        console.log(email);
		if(!re.test(email)){
		   alert("Please enter your email address");
		}else{
		   $.post(url,{email_address: email},function(xhr){
    				  console.log(xhr);
    				if(xhr=="1"){  //success
    				  
    				   $.fancybox.open({
							content: "Thank you for joining our mailing list",
							modal: false,
							closeBtn: true
						});
    				  
    				}else{
    				   alert("There was a problem sending the request. Please try again.");
    				}
    			
    			}); 
    		
		}
		
	});
	
});

// function definitions

function scrollToSection(target_section){
	$('html, body').animate({
    scrollTop: ($("#"+target_section).offset().top-110)
    }, 800);
	
	
}


 function updateCountdown(company){
            	var end_date = $("#"+company).data("enddate");
            	//var target_date = new Date(end_date).getTime();
				//var target_date = Date.parse(end_date);
				var end_date = end_date.split(" ")[0].split("-");
   				 var target_date = new Date( end_date[0], (end_date[1]-1), end_date[2], 0, 0, 0 ).getTime();
				var days, hours, minutes, seconds;
				var current_date = new Date().getTime();
                var seconds_left = (target_date - current_date) / 1000;
                
                days = parseInt(seconds_left / 86400);
				
				$("#"+company).find(".timeleft").children(".fact_number").html(days);
            }
            
            function updateFundedPercentage(company){
            	var goal = $("#"+company).data("goal");
            	var raised = $("#"+company).data("raised");
            	
            	var percentage = Math.ceil(raised*100/goal);
            	
            	//if(percentage <70){ // hide the percentage
            	//	$("#"+company).find(".quickfacts").children(".percentage").remove();
            		
            	//}else{
            	   $("#"+company).find(".quickfacts").children(".percentage").children(".fact_number").html(percentage+"%");
            	//}
            }

function insertParam(key, value)
{
    key = encodeURI(key); value = encodeURI(value);

    var kvp = document.location.search.substr(1).split('&');

    var i=kvp.length; var x; while(i--) 
    {
        x = kvp[i].split('=');

        if (x[0]==key)
        {
            x[1] = value;
            kvp[i] = x.join('=');
            break;
        }
    }

    if(i<0) {kvp[kvp.length] = [key,value].join('=');}

    //this will reload the page, it's likely better to store this until finished
    document.location.search = kvp.join('&'); 
}

// LINKEDIN LOGIN

 // 2. Runs when the JavaScript framework is loaded
  function onLinkedInLoad() {
  
  	$("a.login_with_linkedin").show();
   
  }

  // 2. Runs when the viewer has authenticated
  function onLinkedInAuth() {
    IN.API.Profile("me").fields(["id","firstName","lastName","emailAddress", "summary", "pictureUrl", "publicProfileUrl"]).result(linkedin_login);
  }

  // 2. Runs when the Profile() API call returns successfully
  function linkedin_login(profiles) {
   
     member = profiles.values[0];
     //console.log(member);
    
     $.ajax("processors/linkedin-login-check.html", {
     	type: "POST",
     	data: member,
     	complete: function(xhr,status){
     
     		if(xhr.responseText != "failed"){
     			//linkedin_login_attempt(member.emailAddress, member.id);
     			window.location.href=xhr.responseText;
     		}
     	}
     	
     }) ; 
    
  }
  
function linkedin_login_attempt(email, token){
	$.ajax("/en/member/login.html",{
		type: "POST",
		data: {"username": email, "password": token },
		complete: function(xhr, status){
			console.log(xhr.responseText);
		}
		
	})
}

function linkedin_regsiter_attemp(username, firstname, lastname, summary, token, photo){	
	
}
