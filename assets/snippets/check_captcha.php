<?php
//return $_POST["captcha"] . " / " . $_SESSION['random_number'];

//print_r($_SESSION);

if(!isset($_POST["captcha"]) || empty($_POST["captcha"])){
	return "Please enter the code on screen";
}else if($_POST["captcha"] == $_SESSION['random_number']){
	return "1";
}else{
	return "Please eenter the code on screen";
}