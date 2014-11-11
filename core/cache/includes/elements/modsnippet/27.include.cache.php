<?php
/**
 * parseChunk
 *
 * DESCRIPTION
 *
 * Parse the content of an existing document into a chunk
 * 
 *
 * PROPERTIES:
 *
 * &chunk - required
 * &contentid - requierd
 * &tvs - list of TVs to process
 * &showDefault : 0/1
 *
 * USAGE:
 *
 * [[!parseChunk? &chunk=`CHUNK_NAME` &contentid=`DOCUMENT_ID` &tvs=`content,pagetitle,alias...` &showDefault=`1` ]]
 *
 */

$page = $modx->getObject('modResource', $contentid);
$tvoutput = Array();

$default =  "pagetitle,longtitle,content,alias"; 

if($showDefault){
   $tvoutput = $page->get($defaults);
}

if(!empty($tvs)){
   $tv_list = explode(",",$tvs);
  
   foreach($tv_list as $v){
      $tvvalue = $page->getTVValue($v);
      //$tvoutput["output"] .= $v.": ".$tvvalue;
      $tvoutput[] = Array($v=>$tvvalue);
   }
}





$alltvs = "";

foreach($tvoutput as $k=>$v){
   $alltvs = $k ." contains ".$v."<br /><br />";

}

$tvoutput["output"] .= $tvs;


$output = $modx->getChunk($chunk,$tvoutput);
return $output;
return;
