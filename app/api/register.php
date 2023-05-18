<?php

include_once './config/database.php';
require_once('../../vendor/autoload.php');

header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = '';

$password = '';
$conn = null;

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));

$username = $data->username;

$password = $data->password;
$table_name = 'user';

$query = "INSERT INTO " . $table_name . "
                SET username = ?,
                    password = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $username,$password_hash);

$password_hash = password_hash($password, PASSWORD_BCRYPT);


if ($stmt->execute()) {
    http_response_code(200);
    echo json_encode(array("message" => "User was successfully registered."));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to register the user."));
}

?>