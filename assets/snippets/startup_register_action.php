<?php

$emailTo = $modx->getOption("startup_reg_email");
$emailTo2 = $modx->getOption("member_email");
$emailCC = $modx->getOption("email_cc");


$redirectTo = 49;



if(!empty($_POST)){
   foreach($_POST as $k=>$v){
  // $_POST[$k] = mysql_real_escape_string($v);
}



$subject = "New Investor Request on investable.vc";
$from = "startups@investable.vc";
$message = "<p>Hi,</p><p>There is a new startup registration from Investable.vc on ".date("Y-m-d H:i")."</p>";
$message .= "<h3>Founder Information</h3><p>First Name: ".$_POST["firstname"]."<br />Last Name: ".$_POST["lastname"]."<br />Email: ".$_POST["email"]."</p><hr />";

$message .= "<h3>Company Information</h3>";
$message .= "<p>Business Description:<br />".nl2br($_POST["company_description"])."</p>";
$message .= "<p>Market Opportunities:<br />".nl2br($_POST["market_opportunities"])."</p>";
$message .= "<p>Competitive Advantage:<br />".nl2br($_POST["competitive_advantage"])."</p>";

//$message = json_encode($_POST);

$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY, $message);
$modx->mail->set(modMail::MAIL_FROM, $from);
$modx->mail->set(modMail::MAIL_FROM_NAME, "Investable.vc");
$modx->mail->set(modMail::MAIL_SENDER, $from);;
$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
$modx->mail->address('to', $emailTo, $emailTo);
$modx->mail->address('to', $emailTo2, $emailTo2);
$modx->mail->address('cc', $emailCC, $emailCC);
$modx->mail->address('reply-to', $from);
$modx->mail->setHTML(true);
//call send mail
$sent = $modx->mail->send();

$url = $modx->makeUrl($redirectTo,'',$redirectParams,'full');

}else{
   $url = $modx->makeUrl(12,'',$redirectParams,'full');

}

$modx->sendRedirect($url);

return true;