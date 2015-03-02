<?php

$table = "ext_connection_requests";
$config = $modx->getConfig();
$prefix = $config["table_prefix"];
$emailCC = $modx->getOption("email_cc");
$from = "hello@investable.vc";
$subject = "Pending requests at Investable";
$login_page =$modx->makeUrl(10,'', '', 'full');

$dummyEmail = "alex@investable.vc";
// get all unconfirmed connections
$q = "SELECT count(*) as no_request, `to` as member_id FROM ".$table. " WHERE request_status !='1' GROUP BY `to`";
$r =$modx->query($q);


$count=0;

while( $row = $r->fetch(PDO::FETCH_ASSOC)){
	
	$memberq = "SELECT fullname, email FROM ".$prefix."user_attributes WHERE internalKey=".$row["member_id"];	
	$memberr = $modx->query($memberq);
	$member_row = $memberr->fetch(PDO::FETCH_ASSOC);
	
	$msg = "<p>Hello ".$row["fullname"].",</p>";
	$msg .= "<p>You have ".$row["no_request"]." new connection requests pending at Investable. <a href='".$login_page."' target='_blank'>Login</a> now to see your new connections.</p>";
	$msg .= "<p>&nbsp;</p>";
	$msg .= "<p>Best Regards,<br /><strong>Investable</strong></p>";
	
	$emailTo = $member_row["email"];
	//$emailTo = "alex@investable.vc";
	
	$body =  $modx->getChunk('investable_email_template',array(
   'subject' => $subject, 'msg' => $msg
	));
	
	$modx->getService('mail', 'mail.modPHPMailer');
	$modx->mail->reset();
	$modx->mail->set(modMail::MAIL_BODY, $body);
	$modx->mail->set(modMail::MAIL_FROM, $from);
	$modx->mail->set(modMail::MAIL_FROM_NAME, "Investable.vc");
	$modx->mail->set(modMail::MAIL_SENDER, $from);;
	$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
	$modx->mail->address('to', $emailTo, $emailTo);
	$modx->mail->address('BCC', $emailCC, $emailCC);
	$modx->mail->address('reply-to', $from);
	$modx->mail->setHTML(true);
	//call send mail
	if($sent = $modx->mail->send()){
		$count++;
	}
	
	//echo $member_row["email"]."<br />";
	
}

echo $count ." connection notifications were sent";
