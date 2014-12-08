
$(document).ready(function(){
	$("#newsletter_form").submit(function(e){
		e.preventDefault();
		var email = $("#newsletter_form").find("input#newsletter_email").val();
		var url = $("#newsletter_form").attr("action");
		newsletter_signup_action(email, url);
		
	});
	
	
	
});


