<?php
if(!empty($uid) && is_numeric($uid)){
   $config = $modx->getConfig();
   $user = $uid;
   $ns = "u.";
   $currUser = $modx->getUser();
	$currUserid = $currUser->get("id");
   
   $query = "SELECT a.*, u.username FROM ".$config["table_prefix"]."user_attributes a LEFT JOIN ".$config["table_prefix"]."users u ON a.internalKey =u.id WHERE u.active=1 AND a.internalKey =".$user;
   $result = $modx->query($query);
   if (!is_object($result)) {
       return false;
   }
   else {
      $output = "";
      $row = $result->fetch(PDO::FETCH_ASSOC);
      foreach($row as $k1=>$v1){
	  	$placeholders[$ns.$k1] = $v1;
	  }
	  
      $extended = json_decode($row["extended"]);
	  
	  
      //$placeholders = $row;      
      
      foreach($extended as $k=>$v){
         $placeholders[$ns.$k] = $v;
      }
	  
	  if($placeholders[$ns.$k])
      
	  if(empty($placeholders[$ns."displayname"])){
	  		$placeholders[$ns."displayname"] = substr($placeholders[$ns."fullname"], 0, strpos($placeholders[$ns."fullname"], " "));
		
	  }
	  
	  $placeholders[$ns."photoUrl"] = $row["photo"];
	  if($placeholders[$ns."photoUrl"] == ""){
	  	$placeholders[$ns."photoUrl"] = "/assets/images/default_profile.png";
	  }
	  
      // get user avatar - requires modAvatar snippet
      $photo = $modx->runSnippet("modAvatar", array("userid"=>$row["internalKey"]));
	  $placeholders[$ns."photo"] = $photo;
	  
	  
	  // get member's connection status with currently logged in user 
	  $connection_q = "SELECT * FROM ext_connection_requests WHERE (`from`=".$uid." AND `to`=".$currUserid.") OR (`from`=".$currUserid." AND `to`=".$uid.")";
	 // return $connection_q; 
	  $connection_r = $modx->query( $connection_q);
	  //return $uid ." : " .$connection_r->rowCount()."<br />";
	  if(is_object($connection_r) && $connection_r->rowCount() >0 ){ 
	  	  $is_connected = false;
		  $is_requested = false;
		  while($crow = $connection_r->fetch(PDO::FETCH_ASSOC)){
		  	 if($crow["request_status"] == 1){
		  	 	$is_connected= true;
				 break;
		  	 }else if($crow["to"] == $currUserid){
		  	 	$is_requested = true;
		  	 }
		  }
		  
		  if($is_connected){
		  	$placeholders[$ns."connected"] = "connected";
		  }else if($is_requested){
		  	 $placeholders[$ns."connected"] = "requested";
		  }else{
		  	$placeholders[$ns."connected"] = "sent";
		  }
		
	  }else{
	  	$placeholders[$ns."connected"] = "no";
	  }
	  
	  
       if(!empty($tpl)){
         $output = $modx->getChunk($tpl, $placeholders);
         return $output;
		//return var_dump($placeholders);
      }else{
         return $placeholders;

      }
      
   }

}else{
   return false;
}