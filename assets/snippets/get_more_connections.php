<?php
if(empty($chunk)){
   $chunk = "member_quick_profile_item";
}

if(empty($total)){
	$total = 16;	
}

$config = $modx->getConfig();
$prefix = $config["table_prefix"];
$output ="";
$user = $modx->getUser();



$query = "SELECT u.id FROM ".$prefix."users u ";
$query .= " LEFT JOIN ".$prefix."user_attributes a ON u.id = a.internalKey";
$query .= " LEFT JOIN ".$prefix."member_groups g ON u.id=g.member";
$query .= " WHERE g.role=1 AND g.user_group = 2 AND a.blocked =0 AND u.active=1 AND  u.id != " .$user->get("id");
$query .= " AND u.id NOT IN (SELECT u2.id
FROM ext_connection_requests r
LEFT JOIN ".$prefix."users u2 ON ( u2.id = r.from
OR u2.id = r.to ) 
WHERE u2.id !=".$user->get("id")." AND r.request_status =1)";

if(!empty($_GET["search"])){
	$query .= " AND ((a.fullname LIKE \"%".$_GET["search"]."%\") OR (a.email LIKE \"%".$modx->quote($_GET["search"])."%\")) ";
}

$query .= " ORDER BY RAND() LIMIT ".$total;


$result = $modx->query($query);
if (!is_object($result)) {
   return false;
}else{
   while( $row = $result->fetch(PDO::FETCH_ASSOC)){
      
/*
      $cq = "SELECT * FROM ext_connection_requests WHERE from='".$row["id"]."' AND request_status=0";
      $cr = $modx->query($cq);
      $requested = 0;
      if(is_object($cr)){
         $crow = $cr->fetch(PDO::FETCH_ASSOC);
         if(!empty($crow)){
            $requested = 1;
         }
      }
*/
        
      
      $rowOutput = $modx->runSnippet("getUserById", array("uid"=>$row["id"], "tpl"=>$chunk ));
      $output .= $rowOutput;

   }
}

return $output;