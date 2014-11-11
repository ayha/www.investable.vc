<?php
if(!empty($uid) && is_numeric($uid)){
   $config = $modx->getConfig();
   $user = $uid;
   
   $query = "SELECT a.*, u.username FROM ".$config["table_prefix"]."user_attributes a LEFT JOIN ".$config["table_prefix"]."users u ON a.internalKey =u.id WHERE u.active=1 AND a.internalKey =".$user;
   $result = $modx->query($query);
   if (!is_object($result)) {
       return false;
   }
   else {
      $output = "";
      $row = $result->fetch(PDO::FETCH_ASSOC);
    
      $extended = json_decode($row["extended"]);
      $placeholders = $row;      
      
      foreach($extended as $k=>$v){
         $placeholders[$k] = $v;
      }
      
      // get user avatar - requires modAvatar snippet
      $photo = $modx->runSnippet("modAvatar", array("userid"=>$row["internalKey"]));

      $placeholders["photo"] = $photo;
       if(!empty($tpl)){
         $output = $modx->getChunk($tpl, $placeholders);
         return $output;

      }else{
         return $placeholders;

      }
      
   }

}else{
   return false;
}