<?php  return 'if(empty($companyid)){
   return false;
}else{
$config = $modx->getConfig();
$user = $modx->getUser();


$query = "SELECT * FROM ext_favourite_company WHERE companyid=".$companyid." AND username != \'\' AND userid != \'\' GROUP BY userid ORDER by username";

if(empty($tpl)){
   $tpl = "user_name_item";
}


$result = $modx->query($query);


if(is_object($result)){
   if($getCount == 1){
   return $result->rowCount();
   }else{
      $output = "";
      while($row = $result->fetch(PDO::FETCH_ASSOC)   ){
        
       $rowOutput["uid"] = $row["userid"];
       
        $rowOutput["tpl"] = $tpl;
       
        $output .= $modx->runSnippet("getUserById", $rowOutput);
      }
      return $output;
   }
   
}else{
   return false;
}

}
return;
';