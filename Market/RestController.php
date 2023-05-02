<?php
require_once("RestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "random":
		// to handle REST Url /goods/<view>
		$mobileRestHandler = new RestHandler();
		//$mobileRestHandler->getAllMobiles();
		break;
		
	case "single":
		// to handle REST Url /goods/<id>/
		$mobileRestHandler = new RestHandler();
		$mobileRestHandler->getGood($_GET["id"]);
		break;

	case "" :
		//404 - not found;
		break;
}
?>