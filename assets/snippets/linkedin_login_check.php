<?php
$email = $modx->quote($_POST["emailAddress"]);
$token = $modx->quote($_POST["id"]);
$firstname = $modx->quote($_POST["firstName"]);
$lastname = $modx->quote($_POST["lastName"]);
$summary = $modx->quote($_POST["summary"]);
$photo = $modx->quote($_POST["pictureUrl"]);

$config = $modx->getConfig();

$thisUser = $modx->getUser();


$q = "SELECT u.id, c.userid, c.platform_key, c.platform FROM ".$config["table_prefix"]."users u LEFT JOIN ext_social_connect c ON u.id=c.userid AND platform='linkedin' WHERE username = ".$email;
$result = $modx->query($q);

if(!is_object($result)){
   // user has not registered, try to register
  return "failed";
}else{
	$new_registration = false;
	
   if($row = $result->fetch(PDO::FETCH_ASSOC)){ 
      $userid = $row["id"];
	  
	  // check if user has aprofile pic, if not then use the linkedin one
	  $pq = "SELECT id, internalKey, photo FROM ".$config["table_prefix"]."user_attributes WHERE internalKey = ".$userid;
	  $pr = $modx->query($pq);
	  $prow = $pr->fetch(PDO::FETCH_ASSOC);
	  if($prow["photo"] == ""){
	  	$upq = "UPDATE ".$config["table_prefix"]."user_attributes SET photo=".$photo." WHERE internalKey =".$userid;
		$upr = $modx->query($upq);
	  }
	   
	   
   }else{ // user not registered, attempt to register first
     $user = $modx->newObject('modUser', array ('username'=>$_POST["emailAddress"]));
     $userProfile = $modx->newObject('modUserProfile');
     $userProfile->set('fullname',$_POST["firstName"]." ".$_POST["lastName"]);
	 $userProfile->set('photo',$_POST["pictureUrl"]);
     $userProfile->set('email',$_POST["emailAddress"]);
	
	 $displayname = $_POST["firstName"]." ".substr($_POST["lastName"], 1, 1);
	$linkedin_profile = $_POST["publicProfileUrl"];
	 $reg_date = date("Y-m-d H:i:s");
	$personal_desc = $_POST["summary"]; 
	$extended = Array("usertype"=>"investor", "firstname"=>$_POST["firstName"], "lastname"=>$_POST["lastName"], "displayname"=>$displayname, "linkedin_profile"=>$linkedin_profile, "personal_description"=>$personal_desc, "reg_date"=>$reg_date);
	$userProfile->set("extended", $extended);
     $success = $user->addOne($userProfile);
     if ($success) {
        $user->save();
		 $user->joinGroup('Members','Member');
		 $new_registration = true;
		 
		 $userid = $user->get("id");
		 
		 // update extended profile
		 
			$q = "SELECT * FROM ".$config["table_prefix"]."user_attributes WHERE internalKey = '".$userid."' ";
			
			$result = $modx->query($q);
			
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
			     //return $row["fullname"];
			    
			     $extended = json_encode($extended);
			     //return $extended;
			     $q = "UPDATE ".$config["table_prefix"]."user_attributes SET extended = '".$extended."' WHERE internalKey='".$row["internalKey"]."'";
			     $modx->query($q);
			}
		 
     } else {
        
     }
   
   } // end register
    //return "regsitered user ".$user->get("id");
    
    
    
    if($new_registration || empty($row["userid"])){
       $socialq = "INSERT INTO ext_social_connect (userid, platform, platform_key, date_sent) VALUES (".$userid.", 'linkedin', ".$token.", '".date("Y-m-d H:i:s")."')";
    }else{
       $socialq = "UPDATE ext_social_connect SET platform_key=$token WHERE userid=".$userid;
    }   
   
 
  
    $socialResult = $modx->query($socialq);

    $q2 = "UPDATE ".$config["table_prefix"]."users SET hash_class = 'hashing.modMD5', password = MD5(".$token.") WHERE username = $email";
  
    $r2 = $modx->query($q2);
    
	
	// attempt to login now
	
	if(empty($_POST["return_url"])){
		$url = $modx->makeUrl(43, '', '', 'full');
		
	}else{
		$url=  $_POST["return_url"];
	}
	
	$c = array(
	   'login_context' => 'web',
	   'username' => $_POST["emailAddress"],
	   'password' => $_POST["id"],
	   'returnUrl' => $url,
		 );
	 	$response = $modx->runProcessor('security/login', $c);
  
    	return $url;
}