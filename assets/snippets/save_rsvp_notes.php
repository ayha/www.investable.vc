<?php
if(!empty($_POST["id"]) &&  !empty($_POST["remarks"])){
	
		$query = "UPDATE ext_event_rsvp SET remarks = ".$modx->quote($_POST["remarks"])." WHERE id=".$modx->quote($_POST["id"]);
		//return $query;
		$result = $modx->query($query); 
		return 1;
}