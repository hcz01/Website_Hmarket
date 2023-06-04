<?php
namespace app\Controller;

use mysqli;

class HandlerCredit
{
    function CreateKey($key,$value){
        $servername = "localhost";
        $username = "root";   
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
      }
      
      $sql = "INSERT INTO credittable (credit_key, value, used)
      VALUES ('$key', '$value', false);
       ";
        $result=false;
      try{
        $result = $connection->query($sql); // return true creted , false failed create
        $connection->close();
      }catch(\mysqli_sql_exception $e){
        return false;
      }
      return $result;
          
    }

    function GetStateKey($key) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "hmarket";
        $connection = new mysqli($servername, $username, $password, $db);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
          
        $sql = "SELECT * FROM credittable WHERE credit_key = '$key' ";
        try {
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $connection->close();
            return $row; 
        } catch (\mysqli_sql_exception $e) {
            return 0;
        }
    }
    
//validate key and back key value
function ValidateKey($key) { 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hmarket";
    $connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $value = $this->GetStateKey($key);
    if ($value['used'] == false) {
        $sql = "UPDATE credittable SET used = true WHERE credit_key = '$key'";
        try {
            $result = $connection->query($sql);
            $connection->close();
            $array = array("state" => $result, "credit" => $value['value']);
        } catch (\mysqli_sql_exception $e) {
            $array = array("state" => $result, "problem" => $e);
        }
    } else {
        $array = array("state" => 'false');
    }

    return json_encode($array);
}

    
    
}