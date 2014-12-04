$(document).ready(function(){
	$("#newsletter_form").submit(function(e){
		e.preventDefault();
		var email = $("#newsletter_form").find("input#newsletter_email").val();
		var url = $("#newsletter_form").attr("action");
		newsletter_signup_action(email, url);
		
	});
	
});


// function definitions

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
