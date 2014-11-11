<?php
$config = $modx->getConfig();

$q = "SELECT s.* FROM ext_stage s WHERE hidden !='1' ORDER BY s.sort_order ASC, s.stage ASC";
$result = $modx->query($q);
$selectedArray = Array();

if(isset($_GET["stage"]) && empty($selected)){
   $selected = $_GET["stage"];
   $selectedArray[] = $selected;
}else if(!empty($selected)){
   $selectedArray[] = $selected;
}else if($source == "user"){
$user = $modx->getUser();
$profile = $user->getOne("Profile");

$extended = $profile->get('extended');
$stage = $extended["investment_stage"];
$stage = str_replace("[", "{", $stage);
$stage = str_replace("]", "}", $stage);
$selectedArray = $stage;

}

//return json_encode($selectedArray);

if (!is_object($result)) {
   return false;
}else{
   $output = "";
  
   
   while( $row = $result->fetch(PDO::FETCH_ASSOC)){
      $rowOutput = Array();
      $rowOutput["value"] = $row["stage"];
      $rowOutput["display_text"] = $row["stage"];
      if(in_array($row["stage"],$selectedArray)){
         $rowOutput["selected"] = "selected";
      }
      $output .= $modx->getChunk("option_item", $rowOutput);
   }
   return $output;
}

return false;
return;
