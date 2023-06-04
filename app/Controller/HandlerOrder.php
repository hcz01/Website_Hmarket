<?php
namespace app\Controller;
use app\Controller\HanderUser;
use mysqli;

class Handlerorder
{
    //Create a order
    function Create($id_market,$userid_customer,$userid_seller){
        $servername = "localhost";
        $username = "root";   
        $password = "";
        $db = "hmarket";
        $state_order="ini";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
      
      $sql = "INSERT INTO skin_order (id_market, userid_customer, userid_seller,order_state)
      VALUES ('$id_market','$userid_customer','$userid_seller','$state_order');";
        $result=false;
      try{
        $result = $connection->query($sql); // return true creted , false failed create
        $connection->close();
      }catch(\mysqli_sql_exception $e){
        return false;
      }
      return $result;   
    }
    //Update data of a order
    function Update($order_id,$state_order){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        
        $sql = "UPDATE skin_order SET order_state = '$state_order' WHERE OrderID = $order_id";
        $result = false;
        try {
            $result = $connection->query($sql); 
            $connection->close();
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
        
        return $result;
        
    }
    //get a order
    function Get($order_id) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        $sql = "SELECT * FROM skin_order so 
                JOIN market m  on so.id_market=m.id_market 
                WHERE so.ORDERID = $order_id
                
                ";
        $result = false;
        
        try {
            $query_result = $connection->query($sql);
            if ($query_result && $query_result->num_rows > 0) {
                $result = $query_result->fetch_assoc(); 
            }
            $connection->close();
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
        
        return $result;
    }
    //delect a order
    function Delete($order_id) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        $sql = "DELETE FROM skin_order WHERE order_id = $order_id;";
        $result = false;
        
        try {
            $result = $connection->query($sql);
            $connection->close();
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
        
        return $result;
    }

    function GetOrderByUser($id_user) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        $sql = "SELECT *
        FROM `skin_order` so
        JOIN `market` m ON so.id_market = m.id_market
        JOIN `goods` g ON g.id_good = m.id_good
        JOIN `user-viewer` u ON u.id_user = g.id_user
        WHERE (so.userid_customer =$id_user OR so.userid_seller =$id_user)
        AND so.order_state IN ('ini', 'sended') ";
        
        $result = false;
        
        try {
            $queryResult = $connection->query($sql);
            $result = [];
        
        while ($row = $queryResult->fetch_assoc()) {
            $result[] = $row;
        }
            $connection->close();
        } catch (\mysqli_sql_exception $e) {
            return false;
        }
        
        return $result;
    }

    function CompleteOrder($order_id, $state_order, $userid_customer, $userid_seller, $price)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hmarket";
    $connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $connection->begin_transaction();

    $sql1 = "UPDATE user SET credit = credit - $price WHERE id_user = $userid_customer";
    $sql2 = "UPDATE user SET credit = credit + $price WHERE id_user = $userid_seller";
    $sql3 = "UPDATE skin_order SET order_state = '$state_order' WHERE OrderID = $order_id";

    echo $sql1 . "<br>" . $sql2 . "<br>" . $sql3 . "<br>";

    try {
        $connection->query($sql1);
        $connection->query($sql2);
        $connection->query($sql3);
        $connection->commit();
        $connection->close();
        return true;
    } catch (\mysqli_sql_exception $e) {
        $connection->rollback();
        echo "Error: " . $e->getMessage();
        return false;
    }
}

    
}