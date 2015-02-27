<?php
/*
if(empty($requestid)){
   $requestid = $modx->quote($_POST["requestid"]);
}

if(empty($hash)){
   $hash = $modx->quote($_POST["hash"]);
}


if(!empty($requestid) && !empty($hash)){

$config = $modx->getConfig();
$user = $modx->getUser();
$userid = $user->get("id");

$query = "SELECT * FROM ext_connection_requests WHERE `id`=".$requestid." AND `to`='".$userid."' AND `request_hash`=".$hash;


$result = $modx->query($query);
if (!is_object($result)) {
   return "There was an error sending the request. Please try again.<br />";
}else{
   
    $row = $result->fetch(PDO::FETCH_ASSOC);
   // request approved, update corresponding record and remove the rest;
   $uq1 = "UPDATE ext_connection_requests SET request_status=1, connect_datetime='".date("Y-m-d H:i:s")."' WHERE id=".$requestid;
  
 $ur1 = $modx->query($uq1);
   
   
   // since the 2 users are now connected, remove the redundant request items;
   $uq2 = "DELETE FROM ext_connection_requests WHERE id != ".$requestid." AND ((`to`='".$row["to"]."' AND `from` ='".$row["from"]."') OR (`from`='".$row["to"]."' AND `to`='".$row["from"]."'))";
   $ur2 = $modx->query($uq2);

   
   return "conneted";
}

}else{
   return "invalid parameters";;
}
  * 
  * */
  
 // feb 27, 2015 - simplified the process, just update those records 
$config = $modx->getConfig();
$user = $modx->getUser();
$userid = $user->get("id");
$datetime = date("Y-m-d H:i:s");
$q = "UPDATE ext_connection_requests SET request_status=1, connect_datetime = '".$datetime."' WHERE (`from` = ".$modx->quote($_POST["uid"])." AND `to`=".$modx->quote($userid)." ) ";
$modx->query($q);
return "connected";