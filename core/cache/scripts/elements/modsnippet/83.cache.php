<?php  return '$table = "ext_user_visits";
$user = $modx->getUser();
$userid = $user->get("id");
$url = $_SERVER[\'REQUEST_URI\'];
$ip_addr = $_SERVER[\'REMOTE_ADDR\'];

$q = "INSERT INTO ".$table." (userid, visited_path, ip_address) VALUES (\'".$userid."\', \'".$url."\',\'".$ip_addr."\')";
$result = $modx->query($q);
return;
';