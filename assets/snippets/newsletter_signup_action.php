<?php
$table = "ext_newsletter_signup";
$user = $modx->getUser();
$userid = $user->get("id");
$url = $_SERVER['REQUEST_URI'];
$ip_addr = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER["HTTP_USER_AGENT"];
$email = $_POST["email_address"];


//$q = "INSERT INTO ".$table." (userid, visited_path, ip_address) VALUES ('".$userid."', '".$url."','".$ip_addr."')";
$q = "INSERT INTO ".$table." (email_address, userid, user_agent, ip_address, date_sent) VALUE (".$modx->quote($email).", ".$userid.", ".$modx->quote($user_agent).", ".$modx->quote($ip_addr).", '".date("Y-m-d H:i:s")."')";
$result = $modx->query($q);
//return $result;
if(is_obect($result)){
	
	
	
}else{
	return "-1";
	
}
