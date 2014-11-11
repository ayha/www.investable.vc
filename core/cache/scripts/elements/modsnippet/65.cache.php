<?php  return '$config = $modx->getConfig();
$user = $modx->getUser();
$userid = $user->get("id");

if(empty($chunk)){
   $chunk = "connection_request_item";
}

$query = "SELECT r.id as requestid, r.*, a.* FROM ext_connection_requests r LEFT JOIN ".$config["table_prefix"]."user_attributes a ON a.internalKey=r.from WHERE r.request_status=0 AND (r.to=\'".$userid."\')";

$output = "";

if($getCount==1){
$output =0;
 
}
$result = $modx->query($query);
//return $query;
if (!is_object($result)) {
   return "You have no connection request at this moment";
}else{
   while( $row = $result->fetch(PDO::FETCH_ASSOC)){
      if($getCount==1){
          $output++;
      }else{
         

         
         
         $extended = json_decode($row["extended"]);
         $placeholders = $row;      
      
         foreach($extended as $k=>$v){
         $placeholders[$k] = $v;
         }
          $placeholders["userid"] = $row["internalKey"];
         
         
        
      // get user avatar - requires modAvatar snippet
         $photo = $modx->runSnippet("modAvatar", array("userid"=>$row["from"]));
         $placeholders["photo"] = $photo;

         $rowOutput = $modx->getChunk($chunk, $placeholders);
         $output .= $rowOutput;
        
       
      }
      

   }
}


return $output;
return;
';