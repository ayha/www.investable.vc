<?php
$config = $modx->getConfig();

$ignore_list = "16,17,376,395,397,303,224,45,173,319,259,245,311";

$query = "SELECT count(a.internalKey) as total FROM ".$config["table_prefix"]."user_attributes a ";
$query .= " LEFT JOIN ".$config["table_prefix"]."users u ON a.internalKey =u.id ";
$query .= " LEFT JOIN ".$config["table_prefix"]."member_groups g ON a.internalKey = g.member";
$query .= " WHERE a.blocked!=1 AND g.user_group=2 AND g.role=1 AND internalKey NOT IN (".$ignore_list.")";
$query .= " ORDER BY u.id DESC";
//return $query;
$result = $modx->query($query);

$row = $result->fetch(PDO::FETCH_ASSOC);

return $row["total"];