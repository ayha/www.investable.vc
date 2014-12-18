<?php
if(!empty($url)){
 	
	
 	if(empty($tpl)){
		$tpl = "video_embed_tpl"; 	
 	}
	
	
	
	
	$url = str_replace("watch?v=", "embed/", $url);
	
	$placeholders = Array();
	$placeholders["video_id"] = "video_".time().rand(1, 1000);
	$placeholders["video_url"] = $url;
	if(empty($w)){
		$placeholders["w"] = "100%";
	}else{
		$placeholders["w"] = $w;
	}
	
	if(empty($h)){
		$placeholders["h"] = "320px";
	}else{
		$placeholders["h"] = $h;
	}
	 
	return $modx->getChunk($tpl, $placeholders);
 
 }