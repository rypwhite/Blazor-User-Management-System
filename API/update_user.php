<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require("sql_wrapper.php");


if (!isset($_GET["UID"]) || !isset($_GET["FirstName"]) || !isset($_GET["LastName"]) || !isset($_GET["Age"]) || !isset($_GET["Address"]) || !isset($_GET["Email"]) || !isset($_GET["Phone"])) {
    http_response_code(400);
    $response = array("status" => "error", "message" => "missing information from request");
    die(json_encode($response));
}

$UID = $_GET["UID"];
$FirstName = $_GET["FirstName"];
$LastName = $_GET["LastName"];
$Age = $_GET["Age"];
$Address = $_GET["Address"];
$Email = $_GET["Email"];
$Phone = $_GET["Phone"];

try {
    $sql = new sql_wrapper("plesk.remote.ac", "WS301022_x_api_1nf89n913f", "cB?w66z79", "WS301022_x_api");
    $sql->query("UPDATE `users` SET `FirstName` = ?,`LastName` = ?,`Age` = ?,`Address` = ?,`Email` = ?,`Phone` = ? WHERE `UID` = ?", [$FirstName, $LastName, $Age, $Address, $Email, $Phone, $UID]);
} catch (Exception $e) {
    http_response_code(500);
    $response = array("status" => "error", "message" => $e->getMessage());
    die(json_encode($response));
}

http_response_code(200);
$response = array("status" => "success", "message" => "user updated successfully");
die(json_encode($response));