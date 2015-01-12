<?php
$config = $modx->getConfig();

require_once("assets/snippets/admin_functions.php");
if(empty($tpl)){
	$tpl ="admin_user_table_row";
	
}

$ignore_list = "16,17,376,395,397,303,224,45,173,319,259,245,311";

$query = "SELECT a.*, u.username FROM ".$config["table_prefix"]."user_attributes a ";
$query .= " LEFT JOIN ".$config["table_prefix"]."users u ON a.internalKey =u.id ";
$query .= " LEFT JOIN ".$config["table_prefix"]."member_groups g ON a.internalKey = g.member";
$query .= " WHERE a.blocked!=1 AND g.user_group=2 AND g.role=1 AND internalKey NOT IN (".$ignore_list.")";
$query .= " ORDER BY u.id DESC";
//return $query;
$result = $modx->query($query);

if(is_object($result)){
	$output = "";
	$fields = Array("UserID", "FirstName", "LastName", "Email", "Phone", "Receive Newsletter", "Information Session", "Registration Date");
	$outputArray = Array();
	array_push($outputArray, $fields);
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		$rowOutput = Array();
		$extended= json_decode($row["extended"]);
		//return $extended_fields;
		$display = true;
		if(isset($_GET["promote"])){
			if($_GET["promote"] == "Yes" && $extended->{"promote"} != "Yes"){
				$display = false;
			}
			
			if($_GET["promote"] == "No" && !(empty($extended->{"promote"}) || $extended->{"promote"} == "No")){
				$display = false;
			}
			
		}
		
		$rowOutput["id"] = $row["internalKey"];
		
		$rowOutput["firstname"] = $extended->{"firstname"};
		$rowOutput["lastname"] = $extended->{"lastname"};
		
		$rowOutput["email"] = $row["email"];
		$rowOutput["contact"] = $extended->{"contact_number"};
		$rowOutput["update"] = $extended->{"promote"};
		//$rowOutput["info_session"] = $extended->{"info_session"};
		
		$rowOutput["reg_date"] = $extended->{"reg_date"};
		$rowOutput["total"] = $result->rowCount();
		
		$rowOutput["remarks"] = $extended->{"remarks"};
		
		
		if($display){
			$output .= $modx->getChunk($tpl, $rowOutput);
			array_push($outputArray, $rowOutput);
		}
		 
	}
	
	if($_GET["action"]=="download"){
		array_to_csv_download($outputArray, $filename = "investable_users_".date("Y-m-d").".csv", $delimiter=",");
		
	}else{
		return $output;
	}
}

