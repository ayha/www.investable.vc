<?php
require_once("assets/snippets/admin_functions.php");

$config = $modx->getConfig();


if($_POST["action"] == "save_note"){
	if(!empty($_POST["id"]) && !empty($_POST["remarks"])){
		$query = "UPDATE ext_event_rsvp SET remarks = ".$modx->quote($_POST["remarks"])." WHERE id=".$modx->quote($_POST["id"]);
		return $query;
		$result = $modx->query($query); 
		return 1;
	}else{
		return 0;
	}
	
	
}else{


if(empty($display)){
	$display = 1;
}
$query = "";

if(isset($getEvent) && $getEvent==1){
	$query = "SELECT c.id, c.pagetitle, c.longtitle FROM ext_event_rsvp e ";
	$query .= " LEFT JOIN ".$config["table_prefix"]."site_content c ON e.event_id =  c.id ";
	$query .= " GROUP BY e.event_id ";
	$query .= " ORDER BY e.event_id";
	
	$result = $modx->query($query);
	if(empty($tpl)){
		$tpl ="admin_event_option";
	
	}
	
}else{
	$query = "SELECT e.id, e.name, e.userid, e.email, c.pagetitle as event_name, e.event_id, e.num_attendees, e.remarks FROM ext_event_rsvp e ";
	$query .= " LEFT JOIN ".$config["table_prefix"]."site_content c ON e.event_id =  c.id ";
	
	if(isset($_GET["event_id"]) && !empty($_GET["event_id"])){
		$query .= " WHERE e.event_id = ".$modx->quote($_GET["event_id"]);
	}
	$query .= " ORDER BY e.event_id ASC, e.date_sent DESC";
	$result = $modx->query($query);
	if(empty($tpl)){
		$tpl ="admin_rsvp_row";
	
	}
	
	//return $query;
	
}

if(is_object($result)){
	$output = "";
	$fields = Array("ID","Name", "User ID", "Email", "Event Name", "Event ID", "Attendees", "Remarks");
	$outputArray = Array();
	array_push($outputArray, $fields);
	$total = 0;
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		array_push($outputArray, $row);
		if($display == 1){
	       	
	       $total += $row["num_attendees"];
	       
	       $row["total"] = $total;
		   $output .= $modx->getChunk($tpl, $row);
			
		}
	}
	
	
	if($_GET["action"]=="download"){
		array_to_csv_download($outputArray, $filename = "RSVP_list.csv", $delimiter=",");
		//return "download";
		//echo "<pre>";
		//print_r($outputArray);
		//echo "</pre>";
	}else{
		return $output;
	}
}
}