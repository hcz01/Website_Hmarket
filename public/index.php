<?php
require_once '../vendor/autoload.php';
use app\controller\SiteController;
use app\controller\HanderUser;
use app\controller\HanderAjax;
$request = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);

$siteController = new SiteController();
$HanderUser = new HanderUser();
$handerAjax=new HanderAjax();
switch ($request) {
    case 'home':
        $siteController->Home();
        break;
    case 'login':
        $HanderUser->VerifyUser();
        break;
    case 'register':
        $HanderUser->addUser();
        break;
    case 'protect':
        $HanderUser->VerifyJWT();
        break;
    case 'inventory':
        $siteController->inventory();
        break;
    case 'market':
        $siteController->market();
        break;
    case 'ajax':
        $handerAjax->HanderRequest();
        break;
    case 'goods':
        $siteController->goods();
    break;
    case 'managesell':
        $siteController->managesell();
    break;
    case 'setting':
        $siteController->setting();
    break;

}

?>