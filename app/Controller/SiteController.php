<?php
namespace app\Controller;

class SiteController {
    public function Home () {
        require_once '../app/View/home.php';
    }
    public function inventory () {
        require_once '../app/View/inventory.php';
    }
    public function market(){
        require_once '../app/View/market.php';
    }
    public function goods(){
        require_once '../app/View/goods.php';
    }
    public function managesell(){
        require_once '../app/View/ManageSell.php';
    }
    public function setting(){
        require_once '../app/View/setting.php';
    }
    

    public function NotFound () {
        require_once '../View/404.php';
        http_response_code(404);
    }

}
?>