<?php
$csvfile = "wp_users.csv";
//$count = 0;


//return getcwd();
 $config = $modx->getConfig();
$fields = Array("email", "reg_date", "promote", "personal_description", "facebook", "google_plus", "linkedin_profile", "displayname",  "profile_pic", "twitter");
 
if (($handle = fopen($csvfile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
       // echo "<p> $num fields in line $row: <br /></p>\n";
       if($num == 10 && $row>=1){
       	  $sq = "SELECT * FROM ".$config["table_prefix"]."user_attributes a ";
		  $sq .= " LEFT JOIN ".$config["table_prefix"]."member_groups g ON a.internalKey = g.member";
       	  $sq .= " WHERE a.email='".$data["0"]."' AND g.user_group=2 AND g.role=1 ";
		  
		  $sResult = $modx->query($sq);
		  
		 if($srow = $sResult->fetch(PDO::FETCH_ASSOC)){
		  
		  if(!empty($srow["extended"]) && $srow["extended"] != NULL){
		  	$sExtended = json_decode($srow["extended"]);
			  
		  }else{
		  	 $sExtended = Array();;
			 
		  }
		  // echo $srow["email"]." : " . $sExtended->{"firstname"}."<br /><br />";
		 // echo $srow["email"];
		 // $sExtended->{"usertype"}=
		  for($c=1; $c<$num; $c++){
		  	 if(!empty($data[$c]) && empty($sExtended->{$fields[$c]})){
		  	 	if($fields[$c] == "promote"){
		  	 	   $sExtended->{"promote"} = "Yes";	
				 
		  	 	}else{
		  	 		$sExtended->{$fields[$c]} = $data[$c];
				}
		  	 	//echo $fields[$c].": " . $data[$c]. " / ";
		  	 }
			 //echo "<br /><br />";
			
		  }
		  $fullname = $srow["fullname"];
          $sExtended->{"lastname"} = trim(substr($fullname, strrpos($fullname, " ")));
          $sExtended->{"firstname"} = trim(substr($fullname,0, strrpos($fullname, " ")));
		  $sExtended->{"usertype"} = "investor";
		   $extended = json_encode($sExtended);
			 //echo $extended;
			$uq = "UPDATE ".$config["table_prefix"]."user_attributes SET extended='".trim($extended)."' WHERE internalKey='".$srow["internalKey"]."'";
 		     echo $uq."<br /><br />";
 		    $uresult = $modx->query($uq);
 		     if($uresult->rowCount() <= 0){
 		     	  //echo $uq." FAILED<br /><br />";
			
 		     }
		 }
       }
        $row++;
       // for ($c=0; $c < $num; $c++) {
       //     echo $data[$c] . "<br />\n";
        //}
    }
    fclose($handle);
}else{
	return "unable to open ".$csvfile;
}

/*
$q = "SELECT * FROM modx_user_attributes WHERE internalKey > '".$startid."' ";

if($count >0){
   $q .= " LIMIT ".$count;
}

$result = $modx->query($q);

while($row = $result->fetch(PDO::FETCH_ASSOC)){
     //return $row["fullname"];
    $fullname = $row["fullname"];
    $lastname = substr($fullname, strrpos($fullname, " "));
    $firstname = substr($fullname,0, strrpos($fullname, " "));
 * 
    $displayname = $firstname." ".substr($lastname, 1, 1);
    $usertype = "investor";
    $extended = Array("usertype"=>$usertype, "firstname"=>$firstname, "lastname"=>$lastname, "displayname"=>$displayname);
    
     $extended = json_encode($extended);
     //return $extended;
     $q = "UPDATE modx_user_attributes SET extended = '".$extended."' WHERE internalKey='".$row["internalKey"]."'";
     $modx->query($q);
}
 * 
 * */