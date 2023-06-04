<?php
namespace app\Controller;
use app\Controller\HanderUser;
require_once(__DIR__ . "../../../vendor/autoload.php");
//element for database 

        $HanderUser=new HanderUser();

        $result=$HanderUser->VerifyUser();
        echo $result;




