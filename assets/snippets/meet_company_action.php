<?php
$emailTo = "emma@investable.vc";
$emailCC = "alex@investable.vc";




if(!empty($_POST)){
   foreach($_POST as $k=>$v){
   $_POST[$k] = $modx->quote($v);
  }
  
$user = $modx->getUser();
$userid = $user->get("id");
$profile = $user->getOne("Profile");

$username = $profile->get("fullname");
$useremail = $profile->get("email");

$q = "INSERT INTO ext_meet_company (userid, username, user_email, companyid, companyname, date_sent) VALUES ($userid, '".$username."', '".$useremail."', ".$_POST["companyid"].", ".$_POST["companyname"].", '".date("Y-m-d H:i:s")."')";
$result = $modx->query($q);




if(is_object($result)){
   $subject = "New meeting request from investor ".$username." to meet with ".$_POST["companyname"];
$from = "startups@investable.vc";
$message = "<p>Hi,</p><p>The user <strong>".$username."</strong> (".$useremail.") from Investable.vc has expressed interest in meeting the company <strong>".$_POST["companyname"]."</strong> on ".date("Y-m-d H:i")."</p>";

$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY, $message);
$modx->mail->set(modMail::MAIL_FROM, $from);
$modx->mail->set(modMail::MAIL_FROM_NAME, "Investable.vc");
$modx->mail->set(modMail::MAIL_SENDER, $from);;
$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
$modx->mail->address('to', $emailTo, $emailTo);
$modx->mail->address('cc', $emailCC, $emailCC);
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