<?php 
header("Access-Control-Allow-Origin: *");
require "./../depen/processor/config.php";

require "./../depen/processor/funcs.php";
require './Session.php';
require './dataprocessing.php';
require "./../depen/processor/Model.php";

$pro= new dataprocessing();

if(isset($_REQUEST['login_key']) && !empty($_REQUEST['login_key'])){
	$pro->login();	
}

if(isset($_REQUEST['reg_key']) && !empty($_REQUEST['reg_key'])){
	$pro->register();
}
?>