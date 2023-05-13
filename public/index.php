<?php
require_once '../vendor/autoload.php';
use app\controller\SiteController;

$request = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_SPECIAL_CHARS);

$siteController = new SiteController();

switch ($request) {
    case 'home':
        $siteController->Home();
        break;
   
}

?>