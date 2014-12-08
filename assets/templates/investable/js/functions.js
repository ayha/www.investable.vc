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
	console.log("BEGIN CYCLE");
	
	for(var i=current_partner; i<=(current_partner+partners_displayed-1); i++){
		if(i<=max_partners){
			$(".partner:eq("+(i-1)+")").fadeIn(500);
			displayed++;
			console.log("current " + i);
		}
		
	}
	
	for(var j=1; j<=(partners_displayed-displayed); j++){
		$(".partner:eq("+(j-1)+")").fadeIn(500);
		console.log("return "+j);
	}
	
	console.log("END CYCLE");
	
	
	
}

function show_testimonial(n){
	$(".testimonial:nth-child("+(current_testimonial)+")").fadeOut(300, function(){
		$(".testimonial:nth-child("+(n)+")").fadeIn(500);
		current_testimonial = n;
		
	});
}
