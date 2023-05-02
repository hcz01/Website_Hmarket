<?php

class good{
 private $id;
 private $good_seed;
 private $good_index;
 private $id_category;

 // connect to database as root 

 //back conne already connected ;
 private function connect_database(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hmarket";
    $conn = mysqli_connect($servername, $username, $password,$db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
    return $conn;
 }


 public function Getgood(){
    $ALL_TABLE_SKIN="`agents`,`collections`,`crates`,`graffiti`,`keys`,`music-kits`,`patches`,`skins`,`stickers`"; //no `collectibles`
    $sql = "select id,good_seed,good_index,id_category from `goods`";
 }
 public function SetGoods(){
   
 }
    
}

?>