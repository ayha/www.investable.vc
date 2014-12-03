<?php
$uid = $_POST["uid"];
$notes = $_POST["remarks"];

$config = $modx->getConfig();
$prefix = $config["table_prefix"];

$q = "SELECT extended FROM ".$prefix."user_attributes WHERE internalKey=".$uid;
$result = $modx->query($q);

if(is_object($result)){
$userData = $result->fetch(PDO::FETCH_ASSOC);
	$userExtended = json_decode($userData["extended"]);
	//return $userExtended;
	$userExtended->{"remarks"} = $notes;
	$newExtended = json_encode($userExtended);
	$sq = "UPDATE ".$prefix."user_attributes SET extended='".$newExtended."' WHERE internalKey=".$uid;
	$sr = $modx->query($sq);
	return 1;
}