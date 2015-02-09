<?php
$table = "ext_startup_questions";
$emailTo = $modx->getOption("member_email");
$emailCC = $modx->getOption("email_cc");

//$emailTo = "alex@investable.vc";
//$emailCC = "alex@investable.vc";

$date = date("Y-m-d H:i:s");


if(!empty($_POST)){
	$q = "INSERT INTO ".$table." (user_id, user_name, user_email, company_id, company_name, company_email, question, date_sent ) VALUES (";
	$q .= $modx->quote($_POST["user_id"]).", ".$modx->quote($_POST["user_name"]).", ".$modx->quote($_POST["user_email"]).", ".$modx->quote($_POST["company_id"]).", ".$modx->quote($_POST["company_name"]).", ".$modx->quote($_POST["company_email"]).", ".$modx->quote($_POST["question"]).", ".$modx->quote($date);
	$q .= ")";
	
	$result = $modx->query($q);
	//return $q;
	
	if(is_object($result)){
		$subject = "Question to Startup - ".$_POST["company_name"];
		$from ="invest@investable.vc";
		$message .= "<p>Hi</p>";
		$message .= "<p>The member <strong>".$_POST["user_name"]." (".$_POST["user_email"].")</strong> has submitted a question to ask <strong>".$_POST["company_name"]."</strong></p>";
		$message .= "<p>The question asked was:<br /><strong>".$_POST["question"]."</strong> </p>";
		
		$message .= "<p>Thanks</p>";
		
		
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
		
		return "<p><strong>Thank you for your question!</strong></p><p>We will get back to you shortly.</p>";
	}
	
}
?>

