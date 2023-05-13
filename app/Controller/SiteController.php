<?php
namespace app\Controller;

class SiteController {
    public function Home () {
        require_once '../app/View/home.php';
    }

    public function NotFound () {
        require_once '../View/404.php';
        http_response_code(404);
    }
}
?>