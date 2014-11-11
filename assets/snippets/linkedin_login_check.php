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
   }else{ // user not registered, attempt to register first
     $user = $modx->newObject('modUser', array ('username'=>$_POST["emailAddress"]));
     $userProfile = $modx->newObject('modUserProfile');
     $userProfile->set('fullname',$_POST["firstName"]." ".$_POST["lastName"]);
	 $userProfile->set('photo',$_POST["pictureUrl"]);
     $userProfile->set('email',$_POST["emailAddress"]);
	 $displayname = $_POST["firstName"]." ".substr($_POST["lastName"], 1, 1);
	$linkedin_profile = $_POST["publicProfileUrl"];
			    
	$extended = Array("usertype"=>"investor", "firstname"=>$_POST["firstName"], "lastname"=>$_POST["lastName"], "displayname"=>$displayname, "linkedin_profile"=>$linkedin_profile);
	$userProfile->set("extended", $extended);
     $success = $user->addOne($userProfile);
     if ($success) {
        $user->save();
		 $user->joinGroup('Members','Member');
		 $new_registration = true;
		 
		 $userid = $user->get("id");
		 
		 // update extended profile
		 
			$q = "SELECT * FROM modx_user_attributes WHERE internalKey > '".$userid."' ";
			
			$result = $modx->query($q);
			
			while($row = $result->fetch(PDO::FETCH_ASSOC)){
			     //return $row["fullname"];
			    
			     $extended = json_encode($extended);
			     //return $extended;
			     $q = "UPDATE modx_user_attributes SET extended = '".$extended."' WHERE internalKey='".$row["internalKey"]."'";
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
	$url = $modx->makeUrl(43);
	$c = array(
   'login_context' => 'web',
   'username' => $_POST["emailAddress"],
   'password' => $_POST["id"],
   'returnUrl' => $url,
	 );
 	$response = $modx->runProcessor('security/login', $c);
   // $modx->send
	//return json_encode($response);
	

	//$modx->sendRedirect($url);
    return $url;
  
}