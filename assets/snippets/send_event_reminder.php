<?php
$config = $modx->getConfig();
$user = $modx->getUser();
$userid = $user->get("id");
$eventid = $_GET["eventid"];
$table = "ext_event_rsvp";
$table2 = "ext_email_communications";
$event_table = $config["table_prefix"]."site_tmplvar_contentvalues";
$modx->getService('mail', 'mail.modPHPMailer');
// event_date:62 / event_end:65 / venue:64 / venue_address:67

if(!empty($userid) && !empty($eventid)){
	$q = "SELECT rsvp.*, d.value as event_start, e.value as event_end, v.value as venue, a.value as address FROM ".$table." rsvp ";
	$q .= " LEFT JOIN ".$event_table." d ON rsvp.event_id=d.contentid AND d.tmplvarid=62 ";
	$q .= " LEFT JOIN ".$event_table." e ON rsvp.event_id=e.contentid AND e.tmplvarid=65 ";
	$q .= " LEFT JOIN ".$event_table." v ON rsvp.event_id=v.contentid AND v.tmplvarid=64 ";
	$q .= " LEFT JOIN ".$event_table." a ON rsvp.event_id=a.contentid AND a.tmplvarid=67 ";
	$q .= " WHERE rsvp.event_id=".$modx->quote($_GET["eventid"]);
	$result = $modx->query($q);
	$recipient_list = array();
	while( $row = $result->fetch(PDO::FETCH_ASSOC)){
		$to = $row["email"]; 
		$from = "hello@investable.vc";
		//array_push
		//return $row["email"]; 
		$subject = "Reminder: Invesable Event - ".html_entity_decode($row["event_name"]) . " Tomorrow";
		$message = "Hi, <br /><br />";
		$message .= "This is a reminder that you have RSVP for the Investable event <strong>".$row["event_name"]."</strong><br /><br />";
		$event_date = date("F j, Y", strtotime($row["event_start"]));
		$event_start = date("g:ia", strtotime($row["event_start"]));
		$event_end = date("g:ia", strtotime($row["event_end"]));
		$message .= "When: <strong>".$event_date. " ".$event_start." - ".$event_end."</strong><br /><br />";
		$message .= "Where: <strong>".$row["venue"]."</strong><br />";
		$message .= $row["address"]."<br /><br />";
		$message .= "We look forward to seeing you at the event. <br /><br /><br />Regards,<br />Investable";
		$modx->mail->set(modMail::MAIL_BODY, $message);
		$modx->mail->set(modMail::MAIL_FROM, $from);
		$modx->mail->set(modMail::MAIL_FROM_NAME, "Investable");
		$modx->mail->set(modMail::MAIL_SENDER, $from);;
		$modx->mail->set(modMail::MAIL_SUBJECT, $subject);
		$modx->mail->address('to', $to, $to);
	
		$modx->mail->address('reply-to',$from);
		$modx->mail->setHTML(true);
		//call send mail
		$sent = $modx->mail->send();
		$recipient_list[] = array($to, $sent);
		
		
	}
	
	$q2 = "INSERT INTO ".$table2." (email_type, no_of_recipients, remarks, date_sent) VALUES ('Event Reminder', ".sizeof($recipient_list).", '".json_encode($recipient_list)."', '".date("Y-m-d H:i:s")."')";
	$r2 = $modx->query($q2);
	return $q2;
	
	
	
}else{
	echo "Please login";
}