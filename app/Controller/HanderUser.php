<?php
namespace app\Controller;
use \Firebase\JWT\JWT;
use mysqli;

class HanderUser{
    private $host = "localhost";
    private $db_name = "hmarket";
    private $username = "root";
    private $password = "";
    private $secret_key = "ChengZhou";
    private $issuer_claim = "localhost"; // this can be the servername
    private $audience_claim = "user";
    public $conn;
    function connection(){

            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            $this->conn->set_charset("utf8");
    }
    public function VerifyUser($username,$password){
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        $conn->set_charset("utf8");
        $table_name = 'user';

        $sql = "SELECT * FROM " . $table_name . " WHERE username = $username LIMIT 0,1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id_user'];
            $username = $row['username'];
            $password2 = $row['password'];
            
            if (password_verify($password, $password2)) {
                $secret_key = $this->secret_key;
                $issuer_claim = $this->issuer_claim; // this can be the servername
                $audience_claim = $this->audience_claim;
                $issuedat_claim = time(); // issued at
                $notbefore_claim = $issuedat_claim + 10; //not before in seconds
                $expire_claim = $issuedat_claim + 60; // expire time in seconds
                $token = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "id" => $id,
                        "username" => $username,
                    )
                );

                http_response_code(200);
                $jwt = JWT::encode($token, $secret_key, 'HS256');
                return json_encode(
                    array(
                        "message" => "Successful login.",
                        "jwt" => $jwt,
                        "username" => $username,
                        "expireAt" => $expire_claim
                    )
                );
            } else {
                http_response_code(401);
                return json_encode(array("message" => "Login failed.", "password" => $password));
            }
        }

}
public function addUser($username,$password){
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        $conn->set_charset("utf8");
        $table_name = 'user';
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO " . $table_name . "
                        SET username = $username,
                            password = $password_hash";

        $stmt = $conn->prepare($query);
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(array("message" => "User was successfully registered."));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to register the user."));
        }
}


    
}