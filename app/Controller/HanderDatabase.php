<?php
namespace app\Controller;

use mysqli;

class HanderDatabase {


  function GetProxy() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hmarket";

    // Create a new mysqli connection
    $connection = new mysqli($servername, $username, $password, $db);

    // Check if the connection was successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sql = "SELECT * FROM `proxy`";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $json = [];
        while ($row = $result->fetch_assoc()) {
            $json[] = $row;
        }
        $connection->close();
        return json_encode($json);
    } else {
        $connection->close();
        return json_encode([]);
    }
}

  function getSTEAMID($id) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hmarket";
    $connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $sql = "SELECT `STEAM_ID` FROM `user` WHERE `id_user` = $id";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tradeOfferAccessUrl = $row['STEAM_ID'];
        $connection->close();

        return $tradeOfferAccessUrl;
    } else {
        $connection->close();
        return null;
    }
}




}


