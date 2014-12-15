<?php
$emailTo = $modx->getOption("member_email");
$emailCC = $modx->getOption("email_cc");

$table = "ext_info_sessions";
$user = $modx->getUser();
$userid = $user->get("id");
$profile = $user->getOne("Profile");
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$contact = $_POST["contact"];
$remarks = $_POST["remarks"];

$date = date("Y-m-d H:i:s");


$q = "INSERT INTO ".$table." (userid, fullname, email_address,contact_number, remarks date_sent ) VALUES (".$modx->quote($userid).", ".$modx->quote($fullname).", ".$modx->quote($email).", ".$modx->quote($contact).", ".$modx->quote($remarks).", ".$modx->quote($date).")";

//return $q;

$result = $modx->query($q);


$subject = "New information session request from  ".$fullname;
$from = "invest@investable.vc";
$message = "<p>Hi,</p><p>There is a new request for information session on ".date("Y-m-d H:i").". </p>";
$message .= "<p>Name: ".$fullname."</p>";
$message .= "<p>Email Address: ".$email."</p>";
$message .= "<p>Contact Number: ".$contact."</p>";
$message .= "<p>Remarks: ".$remarks."</p>";



$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY, $message);
$modx->mail->set(modMail::MAIL_FROM, $from);
$modx->mail->set(modMail::MAIL_FROM_NAME, "Investable.vc");
$modx->mail->set(modMail::MAIL_SENDER, $from);;
$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
$modx->mail->address('to', $emailTo, $emailTo);
$modx->mail->address('bcc', $emailCC, $emailCC);
$modx->mail->address('reply-to', $from);
$modx->mail->setHTML(true);
//call send mail
return $modx->mail->send();