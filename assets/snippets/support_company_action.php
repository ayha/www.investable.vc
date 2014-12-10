<?php
$emailTo = $modx->getOption("member_email");
$emailCC = $modx->getOption("email_cc");
$config = $modx->getConfig();

if(!empty($_POST)){
   foreach($_POST as $k=>$v){
   	if($k != "pledge_amount"){
   $_POST[$k] = $modx->quote($v);
	}
  }
  
$user = $modx->getUser();
$userid = $user->get("id");
$profile = $user->getOne("Profile");

$username = $profile->get("fullname");
$useremail = $profile->get("email");

$q = "INSERT INTO ext_support_company (userid, username, user_email, companyid, companyname, pledge_amount, date_sent) VALUES ($userid, '".$username."', '".$useremail."', ".$_POST["companyid"].", ".$_POST["companyname"].", ".$_POST["pledge_amount"].", '".date("Y-m-d H:i:s")."')";
$result = $modx->query($q);

$tvid =13;
$update_q = "UPDATE ".$config["table_prefix"]."site_tmplvar_contentvalues SET value=(value+".$_POST["pledge_amount"].") WHERE tmplvarid=".$tvid ." AND contentid=".$_POST["companyid"];
$r2 = $modx->query($update_q);

if(is_object($result)){
   $subject = "New investment from investor ".$username ." to invest in ".$_POST["companyname"];
$from = "startups@investable.vc";
$message = "<p>Hi,</p><p>The user <strong>".$username."</strong> (".$useremail.") from Investable.vc has expressed interest in investing USD".$_POST["pledge_amount"]." in the company <strong>".$_POST["companyname"]."</strong> on ".date("Y-m-d H:i")."</p>";

$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY, $message);
$modx->mail->set(modMail::MAIL_FROM, $from);
$modx->mail->set(modMail::MAIL_FROM_NAME, "Investable.vc");
$modx->mail->set(modMail::MAIL_SENDER, $from);;
$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
$modx->mail->address('to', $emailTo, $emailTo);
$modx->mail->address('to', $emailCC, $emailCC);
$modx->mail->address('reply-to', $from);
$modx->mail->setHTML(true);
//call send mail
$sent = $modx->mail->send();
  return "Thank you for your interest in ".$companyname.". We will be in touch with you shortly.";
}else{
   return "There was an error sending the request, please try again.";
}
}else{
   return "There was an error sending the request, please try again.";
}