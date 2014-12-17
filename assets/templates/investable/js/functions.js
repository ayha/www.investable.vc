// function definitions
var current_partner=1;
var partners_displayed = 4;
var current_testimonial = 1;
function newsletter_signup_action(email, action_url){
	
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
       
		if(!re.test(email)){
		   alert("Please enter your email address");
		}else{
		   $.post(action_url,{email_address: email},function(xhr){
    				
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
}

function show_more_partners(){
	var max_partners= $(".partners_wrapper .partner").length;
	var displayed = 0;
	$(".partner").hide();
	current_partner += 2;
	
	if(current_partner > max_partners){
		current_partner = current_partner-max_partners;
	}
	
	
	for(var i=current_partner; i<=(current_partner+partners_displayed-1); i++){
		if(i<=max_partners){
			$(".partner:eq("+(i-1)+")").fadeIn(500);
			displayed++;
			
		}
		
	}
	
	for(var j=1; j<=(partners_displayed-displayed); j++){
		$(".partner:eq("+(j-1)+")").fadeIn(500);
		
	}
	
	
}

function show_testimonial(n){
	$(".testimonial:nth-child("+(current_testimonial)+")").fadeOut(300, function(){
		$(".testimonial:nth-child("+(n)+")").fadeIn(500);
		current_testimonial = n;
		
	});
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

 // 2. Runs when the JavaScript framework is loaded
  function onLinkedInLoad() {

  	IN.Event.on(IN, "auth", onLinkedInAuth);
   
  }

  // 2. Runs when the viewer has authenticated
  function onLinkedInAuth() {
    IN.API.Profile("me").fields(["id","firstName","lastName","emailAddress", "summary", "pictureUrl", "publicProfileUrl"]).result(linkedin_login);
  	
  }

  // 2. Runs when the Profile() API call returns successfully
  function linkedin_login(profiles) {
   
     member = profiles.values[0];
    
    
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




// member functions

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
	
	if(days <=10){
		$("#"+company).find(".ribbon").html(days + " Days Left");
		$("#"+company).find(".ribbon").addClass("active");
	}
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


function addRibbon(wrapper, text){
	
}

function updateInvestorIcons(wrapper){
	$(wrapper).find(".key_investors").children(".key_investor_img").each(function(ind, ele){
    		console.log($(ele));
    		var src= $(ele).attr("src");
    		var html ='<div class="invested_by">Invested in by <img src="'+src+ '" /></div>';
    		$(this).parent().append(html);
     });
	
}
