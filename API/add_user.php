<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require("sql_wrapper.php");

if (!isset($_GET["FirstName"]) || isset($_GET["LastName"]) || isset($_GET["Age"]) ||isset($_GET["Address"]) ||isset($_GET["Email"]) ||isset($_GET["Phone"])) {
    http_response_code(400);
    $response = array("status" => "error", "message" => "missing information from request");
    die(json_encode($response));
}

$firstName = $_GET["firstName"];
$LastName = $_GET["LastName"];
$Age = $_GET["Age"];
$Address = $_GET["Address"];
$Email = $_GET["Email"];
$Phone = $_GET["Phone"];

try {
    $sql = new sql_wrapper("plesk.remote.ac", "WS301022_x_api_1nf89n913f", "cB?w66z79", "WS301022_x_api");
    $sql->query("INSERT INTO `users`(`UID`, `FirstName`, `LastName`, `Age`, `Address`, `Email`, `Phone`, `Timestamp`) VALUES (NULL,?, ?, ?, ?, ?, ?, current_timestamp())", [$firstName, $lastName, $Age, $Address, $Email, $Phone]);
} catch (Exception $e) {
    http_response_code(500);
    $response = array("status" => "error", "message" => $e->getMessage());
    die(json_encode($response));
}

http_response_code(200);
$response = array("status" => "success", "message" => "added record for $firstName $lastName successfully");
die(json_encode($response));