<?php
use app\Controller\HanderUser;
require_once(__DIR__ . "../../../vendor/autoload.php");
//element for database 

$HanderUser=new HanderUser();
$username=$_POST['username'];
$password=$_POST['password'];
$result=$HanderUser->VerifyUser($username,$password);
echo $result;



