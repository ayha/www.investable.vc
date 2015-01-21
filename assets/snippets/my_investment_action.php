<?php
if(isset($_POST["action"])){
	$action = $_POST["action"];
	$user = $modx->getUser();
	$userid = $user->get("id");
	
	if($action == "save"){ 
		$table = "ext_user_investment_portfolio";
		if(!empty($userid)){
			$portfolio = Array();
			$portfolio["user"] = $userid;
			$portfolio["portfolio"] = Array();
			for($i=0; $i<sizeof($_POST["investment_name"]); $i++){
				$obj = Array();
				$obj["name"] = $_POST["investment_name"][$i];
				$obj["amount"] = $_POST["investment_amount"][$i];
				$obj["monthly_return"] = $_POST["monthly_return"][$i];
				array_push($portfolio["portfolio"], $obj); 
				
			}
			
			$check = "SELECT * FROM ".$table." WHERE userid=".$modx->quote($userid);
			$checkr = $modx->query($check);
			if($checkr->rowCount() >0){
				//$result->rowCount();
				$q = "UPDATE ".$table." SET portfolio=".$modx->quote(json_encode($portfolio)) ." WHERE userid=".$modx->quote($userid);
				
			}else{
				$q = "INSERT INTO ".$table." (userid, portfolio) VALUES (".$modx->quote($userid).", ".$modx->quote(json_encode($portfolio)).")";
			}
			$result = $modx->query($q);
			return "Your investments have been saved.";
		}
	}
	
	//return $action;
}