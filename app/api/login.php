<?php
include_once './config/database.php';
require_once('../../vendor/autoload.php');
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
error_reporting(E_ALL);
ini_set('display_errors', 1);
$username = '';
$password = '';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;

$table_name = 'user';

$sql = "SELECT * FROM " . $table_name . " WHERE username = ? LIMIT 0,1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id_user'];
    $username = $row['username'];
    $password2 = $row['password'];

    if (password_verify($password, $password2)) {
        $secret_key = "YOUR_SECRET_KEY";
        $issuer_claim = "THE_ISSUER"; // this can be the servername
        $audience_claim = "THE_AUDIENCE";
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
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "username" => $username,
                "expireAt" => $expire_claim
            )
        );
    } else {
        http_response_code(401);
        echo json_encode(array("message" => "Login failed.", "password" => $password));
    }
}



?>