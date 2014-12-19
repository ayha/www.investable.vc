<?php
$emailTo = $modx->getOption("member_email");
$emailCC = $modx->getOption("email_cc");
$user = $modx->getUser();
$userid = $user->get("id");
$date = date("Y-m-d H:i:s");
if(!empty($_POST)){
	$q = "INSERT INTO ext_event_rsvp (name, userid, email, event_name, event_id, num_attendees, date_sent) VALUES (".$modx->quote($_POST["name"]).", $userid, ".$modx->quote($_POST["email"]).", ".$modx->quote($_POST["eventname"]).", ".$modx->quote($_POST["eventid"]).", ".$modx->quote($_POST["no_attendees"]).", ".$modx->quote($date)."  )";
	$result = $modx->query($q);
	//return $q;
$subject = "RSVP for Investable Event - ".$_POST["eventname"];
$from = "contact@investable.vc";
//$message = "<p>Hi,</p><p>E <strong>".$username."</strong> (".$useremail.") from Investable.vc has expressed interest in meeting the company <strong>".$_POST["companyname"]."</strong> on ".date("Y-m-d H:i")."</p>";
$message = "<p>Event Name: <strong>".$_POST["eventname"]."</strong></p>";
$message .= "<p>Member: <strong>".$_POST["name"]." (".$_POST["email"].")</strong></p>";
$message .= "<p>Number of Attendees: <strong>".$_POST["no_attendees"]."</strong></p>";

$modx->getService('mail', 'mail.modPHPMailer');
$modx->mail->set(modMail::MAIL_BODY, $message);
$modx->mail->set(modMail::MAIL_FROM, $from);
$modx->mail->set(modMail::MAIL_FROM_NAME, "Investable");
$modx->mail->set(modMail::MAIL_SENDER, $from);;
$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
$modx->mail->address('to', $emailTo, $emailTo);
$modx->mail->address('cc', $emailCC, $emailCC);
$modx->mail->address('reply-to', $from);
$modx->mail->setHTML(true);
//call send mail
$sent = $modx->mail->send();
if($sent){
	return "You have successfully RSVP for the event <strong>".$_POST["eventname"]."</strong><br />See you at the event.";
}
	
} else{
	return "There was an error sending the request, please try again.";
}