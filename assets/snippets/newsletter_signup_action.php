<?php
$emailTo = "alex@investable.vc";
$emailCC = "alex@investable.vc";
$table = "ext_newsletter_signup";
$user = $modx->getUser();
$userid = $user->get("id");
$email = $_POST["email_address"];
$user_agent = $_SERVER["HTTP_USER_AGENT"];
$ip_addr = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d H:i:s");


$q = "INSERT INTO ".$table." (email_address, userid, user_agent, ip_address, date_sent) VALUES (".$modx->quote($email).", ".$modx->quote($userid).", ".$modx->quote($user_agent).", ".$modx->quote($ip_addr).", ".$modx->quote($date).")";

$result = $modx->query($q);


$subject = "New mailing list request from ".$email;
$from = "hello@investable.vc";
$message = "<p>Hi,</p><p>There is a new mailing list request on ".date("Y-m-d H:i")." from ".$email."</p>";


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
return $modx->mail->send();