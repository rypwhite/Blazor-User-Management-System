<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require("sql_wrapper.php");

//$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_GET["UID"])) {
    http_response_code(400);
    $response = array("status" => "error", "message" => "missing information from request");
    die(json_encode($response));
}

$uid = $_GET["UID"];

try {
    $sql = new sql_wrapper("plesk.remote.ac", "WS301022_x_api_1nf89n913f", "cB?w66z79", "WS301022_x_api");
    $user = $sql->query("SELECT * FROM `users` WHERE `UID` = ?", [$uid])->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    http_response_code(500);
    $response = array("status" => "error", "message" => $e->getMessage());
    die(json_encode($response));
}

if (!$user) {
    http_response_code(404);
    $response = array("status" => "error", "message" => "no user found with UID " . $uid);
    die(json_encode($response));
}

try {
    $sql->query("DELETE FROM `users` WHERE `UID` = ?", [$uid]);
} catch (Exception $e) {
    http_response_code(500);
    $response = array("status" => "error", "message" => $e->getMessage());
    die(json_encode($response));
}

http_response_code(200);
$response = array("status" => "success", "message" => "deleted user $uid from database");
die(json_encode($response));