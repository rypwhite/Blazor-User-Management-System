<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require("sql_wrapper.php");

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data["UID"]) || !isset($data["FirstName"]) || isset($data["LastName"]) || isset($data["Age"]) ||isset($data["Address"]) ||isset($data["Email"]) ||isset($data["Phone"])) {
    http_response_code(400);
    $response = array("status" => "error", "message" => "missing information from request");
    die(json_encode($response));
}

$UID = $data["UID"];
$firstName = $data["firstName"];
$LastName = $data["LastName"];
$Age = $data["Age"];
$Address = $data["Address"];
$Email = $data["Email"];
$Phone = $data["Phone"];

try {
    $sql = new sql_wrapper("plesk.remote.ac", "WS301022_x_api_1nf89n913f", "cB?w66z79", "WS301022_x_api");
    $sql->query("UPDATE `users` SET `FirstName` = ?,`LastName` = ?,`Age` = ?,`Address` = ?,`Email` = ?,`Phone` = ? WHERE `UID` = ?", [$firstName, $lastName, $Age, $Address, $Email, $Phone, $UID]);
} catch (Exception $e) {
    http_response_code(500);
    $response = array("status" => "error", "message" => $e->getMessage());
    die(json_encode($response));
}

http_response_code(200);
$response = array("status" => "success", "message" => "user updated successfully");
die(json_encode($response));