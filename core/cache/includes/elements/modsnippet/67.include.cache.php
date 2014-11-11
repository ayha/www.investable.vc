<?php
$stage = "";
$industry= "";	

$stagetv = 32;
$industrytv= 25;
$parentid = 36;

$config = $modx->getConfig();


if(isset($_GET["stage"])){
  $stage = $_GET["stage"];
}

if(isset($_GET["industry"])){
   $industry = $_GET["industry"];
}



$q = "SELECT DISTINCT c.id as companyid FROM ".$config["table_prefix"]."site_content c LEFT JOIN ".$config["table_prefix"]."site_tmplvar_contentvalues tv ON tv.contentid = c.id WHERE c.parent=".$parentid . " AND published='1' AND deleted ='0'";

if(!empty($industry)){
   $q .= " AND (tv.tmplvarid=".$industrytv." AND tv.value LIKE '%".$industry."%')";
}

if(!empty($stage)){
   $q .= " AND (tv.tmplvarid=".$stagetv." AND tv.value LIKE '%".$stage."%')";
}
//return $q;

$result = $modx->query($q);
if(is_object($result)){
   $companyids = Array();
   while( $row = $result->fetch(PDO::FETCH_ASSOC)){
      array_push($companyids, $row["companyid"]);
   }
   
   $ids = implode(",", $companyids);

   if(empty($ids)){
       return "There is no startup company matching your criteria at the moment. Please check back soon.";
   }else{
   $params = Array("resources"=>$ids, "tpl"=>"startup_list_chunk", "sortby"=>'{"publishedon":"DESC","menuindex":"ASC"}', "limit"=>"1000", "depth"=>0, "showHidden"=>0, "includeTVs"=>1, "processTVs"=>1, "showUnpublished"=>0);
    return $modx->runSnippet("getResources", $params);
    }

}else{
   return "There is no startup company matching your search at the moment. Please check back soon.";
}
return;
