<?php
if(empty($chunk)){
   $chunk = "connection_item";
}

$config = $modx->getConfig();
$prefix = $config["table_prefix"];
$output ="";
$user = $modx->getUser();
$query = "SELECT DISTINCT u.id FROM ".$prefix."users u ";
$query .= " LEFT JOIN ".$prefix."user_attributes a ON u.id = a.internalKey";
$query .= " LEFT JOIN ".$prefix."member_groups g ON u.id=g.member";
$query .= " LEFT JOIN ext_connection_requests r ON (u.id = r.from OR u.id = r.to)";
$query .= " WHERE g.role=1 AND g.user_group = 2 AND r.request_status=1 AND a.blocked =0 AND u.active=1 AND  u.id != ".$user->get("id");
$query .= " ORDER BY a.fullname ASC, u.username ASC";

//return $query;

$result = $modx->query($query);
if (!is_object($result)) {
   return "<p>You do not have any connections at the moment.</p>";
}else{
	if($getCount == 1){
  		 return $result->rowCount();
   	}else{
	
   while( $row = $result->fetch(PDO::FETCH_ASSOC)){
      $rowOutput = $modx->runSnippet("getUserById", array("uid"=>$row["id"], "tpl"=>$chunk ));
      $output .= $rowOutput;

   }
   if($output ==""){
      $output = "<p>You do not have any connections at the moment.</p>";
   }
	}
}

return $output;