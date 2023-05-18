<?php
use ReallySimpleJWT\Token;
require_once(__DIR__ . "/../../../vendor/autoload.php");
//element for database 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "hmarket";
  $connection = new \mysqli($servername, $username, $password, $db);
  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
  //element for JWT
  $secret = 'lavoro';
  $expiration = time() + 3600;
  $issuer = 'localhost';
  $userId = "0";

    $user =$_GET['username'];
    $pass = $_GET['password'];

    $sql = "SELECT id_user FROM `user` WHERE username='$user' AND password ='$pass' ";
 
    $result = $connection->query($sql);;
    $data = array();
    if ($result->num_rows > 0) {
      // found user in this moment
        $row = $result->fetch_assoc();
        foreach ($row as $r) {
          if(is_numeric($r))
          {
            $myobj = new stdClass();
            $myobj->userid = $r;
            $myobj->username=$user;
            $data[] = $myobj;
          }
      }     
    }else{
      //didnt find user
      $myobj->result= "failed";
      $data[] = $myobj;
    }

$json_data = json_encode($data);

echo $json_data;


