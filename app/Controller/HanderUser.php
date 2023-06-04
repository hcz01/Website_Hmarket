<?php
namespace app\Controller;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use mysqli;

class HanderUser{
    private $host = "localhost";
    private $db_name = "hmarket";
    private $username = "root";
    private $password = "";
    private $secret_key = "chengzhou";
    private $issuer_claim = "localhost";
    private $audience_claim = "user";
    public $conn;

    public function VerifyUser(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        $conn->set_charset("utf8");
        $table_name = 'user';

        $sql = "SELECT * FROM " . $table_name . " WHERE username = '$username' LIMIT 0,1";
        $stmt = $conn->prepare($sql);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id_user'];
            $username = $row['username'];
            $password2 = $row['password'];
      
            if (password_verify($password, $password2)) {
                $secret_key = $this->secret_key;
                $issuer_claim = $this->issuer_claim;
                $audience_claim = $this->audience_claim;
                $issuedat_claim = time(); // issued at
                $expire_claim = $issuedat_claim + 36000; // expire time in seconds
                $token = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "id" => $id,
                        "username" => $username,
                    )
                );
               
                http_response_code(200);
                $jwt = JWT::encode($token, $secret_key, 'HS256');
              echo json_encode(
                array(
                    "message" => "Successful login.",
                    "jwt" => $jwt,
                    "id" => $id,
                    "username" => $username,
                    "expireAt" => $expire_claim
                )
            );

            } else {
                http_response_code(401);
                echo json_encode(array("message" => "Login failed.", "password" => $password));
            }
        }else{
            $this->addUser();
        }

}

public function addUser(){
    $username=$_POST['username'];
    $password=$_POST['password'];
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        $conn->set_charset("utf8");
        $table_name = 'user';
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO " . $table_name . "
                        SET username = '$username',
                            password = '$password_hash' ";

        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(array("message" => "User was successfully registered."));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to register the user."));
        }
}

public function VerifyJWT(){
        /*
      header("Access-Control-Allow-Origin: *");
      header("Content-Type: application/json; charset=UTF-8");
      header("Access-Control-Allow-Methods: POST");
      header("Access-Control-Max-Age: 3600");
      header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
      */
      $jwt = null;
      $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
      $conn->set_charset("utf8");


    // check forauthroizzation
    if (isset($_SERVER['AUTHORIZATION'])) {
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        $arr = explode(" ", $authHeader);
        $jwt = $arr[1];

        //check cookie
    }else if(isset($_COOKIE['jwt'])){
        $jwt=$_COOKIE['jwt'];
    }
    $decoded = JWT::decode($jwt, new Key($this->secret_key, 'HS256'));
    if($jwt!=null) {
        try {
            $decoded = JWT::decode($jwt, new Key($this->secret_key, 'HS256'));
          // JWT is valid, perform necessary actions
          echo json_encode(array(
            "message" => "Access granted",
            "data" => $decoded
          ));
        } catch (\Exception $e) {
          if ($e instanceof \Firebase\JWT\ExpiredException) {
            // Token expired, return 401 Unauthorized status
            http_response_code(401);
            echo json_encode(array(
              "message" => "Token expired",
              "error" => $e->getMessage()
            ));
          } else {
            // Other JWT validation errors, return 400 Bad Request status or appropriate error status
            http_response_code(400);
            echo json_encode(array(
              "message" => "JWT validation failed",
              "error" => $e->getMessage()
            ));
          }
        }
      } else {
        // JWT not provided, return 401 Unauthorized status
        http_response_code(401);
        echo json_encode(array(
          "message" => "Access denied",
          "error" => "JWT not provided"
        ));
      }  
    }
//impost
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

// credit
function GetCredit($userid){
      $servername = "localhost";
      $username = "root";   
      $password = "";
      $db = "hmarket";
      $connection = new mysqli($servername, $username, $password, $db);
      if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT credit FROM user
    WHERE `id_user` = '$userid' LIMIT 1";

      $result = $connection->query($sql);
      if ($result->num_rows > 0) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $connection->close();
        return json_encode($rows);
      } else {
          $connection->close();
          return null;
      }
}

function UpdateCredit($credit,$userid){
    $servername = "localhost";
    $username = "root";   
    $password = "";
    $db = "hmarket";
    $connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }

  $sql = "UPDATE user
  SET credit = credit + $credit
  WHERE id_user = $userid";

    try{
      $result = $connection->query($sql); 
    }catch(\mysqli_sql_exception $e){
      $connection->close();
    }finally{
      return $result;
    }
}

function UpdateUserInfo($info,$userid){
  $servername = "localhost";
    $username = "root";   
    $password = "";
    $db = "hmarket";
    $connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
  $data = json_decode($info, true);
  $steamID = $data['STEAM_ID'];
  $apiKey = $data['API_key'];
  $tradeUrl = $data['trade_offer_access_url'];
  $email = $data['email'];

  $sql = "UPDATE user
          SET STEAM_ID = '$steamID',
              API_key = '$apiKey',
              trade_offer_access_url = '$tradeUrl',
              email = '$email'
          WHERE id_user = $userid";
    try{
      $result = $connection->query($sql); 
    }catch(\mysqli_sql_exception $e){
      $connection->close();
    }finally{
      return $result;
    }
}
function getUserInfo($userid) {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "hmarket";
  $connection = new mysqli($servername, $username, $password, $db);
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
  $sql = "SELECT * FROM `user` WHERE `id_user` = $userid";
  try{
    $result = $connection->query($sql); 
    $result=$result->fetch_assoc();
  }catch(\mysqli_sql_exception $e){
    $connection->close();
  }finally{
    return $result;
  }
}

}
