<?php
$config = $modx->getConfig();
$user = $modx->getUser();
$userid = $user->get("id");

$prefix = $config["table_prefix"];

// get custom investment items
if(empty($tpl)){
	$tpl = "investment_portfolio_item";
}

$query = "SELECT * FROM ext_user_investment_portfolio WHERE userid = ".$modx->quote($userid);
$result = $modx->query($query); 
//return $query;
$output= "";
if (is_object($result)) {
	while( $row = $result->fetch(PDO::FETCH_ASSOC)){
		$portfolio = json_decode($row["portfolio"], true);
		//print_r($portfolio);
		foreach($portfolio["portfolio"] as $k=>$v){
			$rowOutput = Array(); 
			foreach($v as $k2=>$v2){
			
			$rowOutput[$k2] = $v2;
			} 
			$rowOutput["investment_type"] = "custom";
			$rowOutput["additional_info"] = "N/A";
			$output .= $modx->getChunk($tpl, $rowOutput);
			
		}
		//return var_dump($output);
		
	}
	
}

//return $output;

// get investable specific investment items
$query2 = "SELECT * FROM ext_support_company WHERE userid=".$modx->quote($userid);
$result2 = $modx->query($query2);

if (is_object($result2) && $result2->rowCount()>0) {
		$rowOutput = Array();
		$rowOutput["investment_type"] = "investable";
		$rowOutput["name"] = "investable";
		$investable = Array();
		$totalAmt = 0; 
	while( $row2 = $result2->fetch(PDO::FETCH_ASSOC)){
		
		$countryTVID = 40;
		$industryTVID = 25; 
		$totalAmt += $row2["pledge_amount"];
		$countryQ = "SELECT value as country FROM ".$prefix."site_tmplvar_contentvalues WHERE tmplvarid =".$modx->quote($countryTVID)." AND contentid=".$modx->quote($row2["companyid"]);
		$countryR = $modx->query($countryQ);
		
		if($countryRow = $countryR->fetch(PDO::FETCH_ASSOC)){
			$row2["country"] = $countryRow["country"];
		}
		 
		$industryQ = "SELECT value as industry FROM ".$prefix."site_tmplvar_contentvalues WHERE tmplvarid=".$modx->quote($industryTVID)." AND contentid=".$modx->quote($row2["companyid"]);
		$industryR = $modx->query($industryQ);
		if($industryRow = $industryR->fetch(PDO::FETCH_ASSOC)){
			$row2["industry"] = $industryRow["industry"];
		}
		
		array_push($investable, $row2);
		//$industryQ = "SELEC"
		
	}
	$rowOutput["additional_info"] =addslashes(json_encode($investable));
	$rowOutput["amount"] = $totalAmt;
	$output .= $modx->getChunk($tpl, $rowOutput);
}

if(empty($output)){
	return "";
}else{
	return $output;
	
}