<?php
namespace app\Controller;

use mysqli;

class HanderDatabase {


  function setItems($id_user,$itemid,$classid,$instanceid,$market_name,$name,$icon_url,$icon_url_large,$link) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hmarket";
    $connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
   
    $sql = "INSERT INTO goods (id_user, itemid, classid, instanceid, market_name, name, icon_url, icon_url_large, link)
    VALUES ('$id_user', '$itemid', '$classid', '$instanceid', '$market_name', '$name', '$icon_url', '$icon_url_large', '$link')";
    
    if ($connection->query($sql) === TRUE) {
      return "success";
    } else {
      return "failed";
    }
    
    $connection->close();

}
function getItemsById_user($id_user) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hmarket";
    $connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sql = "SELECT * FROM `goods` WHERE `id_user` = $id_user";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $connection->close();

        return json_encode($items);
    } else {
        $connection->close();
        return null;
    }
}

}


