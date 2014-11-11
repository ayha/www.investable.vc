<?php
$q = "SELECT * FROM ext_industries WHERE  hidden !='1' ORDER BY sort_order ASC, industry ASC";
$result = $modx->query($q);
$selectedArray = Array();

if(isset($_GET["industry"]) && empty($selected)){
   $selected = $_GET["industry"];
   $selectedArray[] = $selected;
}else if(!empty($selected)){
   $selectedArray[] = $selected;
}else if($source == "user"){
$user = $modx->getUser();
$profile = $user->getOne("Profile");

$extended = $profile->get('extended');
$industry = $extended["investment_industries"];
$industry = str_replace("[", "{", $industry);
$industry = str_replace("]", "}", $industry);


$selectedArray = $industry;
}

if (!is_object($result)) {
   return false;
}else{
   $output = "";

   

   while( $row = $result->fetch(PDO::FETCH_ASSOC)){
      $rowOutput = Array();
      $rowOutput["value"] = $row["industry"];
      $rowOutput["display_text"] = $row["industry"];
      if(in_array($row["industry"],$selectedArray)){
         $rowOutput["selected"] = "selected";

      }
      $output .= $modx->getChunk("option_item", $rowOutput);
   }
   return $output;
}

return false;
return;
