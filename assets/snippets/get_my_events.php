<?php
if(empty($tpl)){
	$tpl = "event_item_banner";
}
if(empty($total)){
	$total = 5;	
}

$config = $modx->getConfig();
$prefix = $config["table_prefix"];
$output ="";
$user = $modx->getUser();


$q = "SELECT DISTINCT e.event_id FROM ext_event_rsvp e ";
//$q .= " LEFT JOIN ".$prefix."site_content c ON e.event_id = c.id ";
//$q .= " LEFT JOIN ".$prefix."site_tmplvar_contentvalues tv ON e.event_id = tv.contentid ";
$q .= " WHERE e.userid=".$user->get("id");
$q .= " ORDER BY e.event_id";
$q .= " LIMIT ".$total;
 
 
$result = $modx->query($q);
if (!is_object($result)) {
   return "You have not registered for any events yet. Checkout our <a href='[[~132]]'>upcoming events</a>.";
}else{
   while( $row = $result->fetch(PDO::FETCH_ASSOC)){
   	$rowOutput = Array();
	
    $document = $modx->getObject('modResource',array(
    'published' => 1,
    'id' => $row["event_id"],
	));
	
	
	$rowOutput["tv.past_event"] = $document->getTVValue("past_event");
	
	
	$rowOutput["id"] = $row["event_id"];
	$rowOutput["longtitle"] = $document->get("pagetitle");
	$rowOutput["tv.venue"] = $document->getTVValue("venue");
	$rowOutput["tv.event_date"] = $document->getTVValue("event_date");
	$rowOutput["tv.event_end"] = $document->getTVValue("event_end");
	
	if($rowOutput["tv.past_event"] != 1){
	//return $document->getTVValue('venue');
   	$output .= $modx->getChunk($tpl, $rowOutput);
	}
     // $rowOutput = $modx->runSnippet("getUserById", array("uid"=>$row["id"], "tpl"=>$chunk ));
     // $output .= $rowOutput;
    
    
   }
}

if($output == ""){
	 return "You have not registered for any events yet. Checkout our <a href='[[~132]]'>upcoming events</a>.";

}else{
	return $output;
}