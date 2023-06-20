<?php

require("sql_wrapper.php");

try {
    $sql = new sql_wrapper("plesk.remote.ac", "WS301022_x_api_1nf89n913f", "cB?w66z79", "WS301022_x_api");
    $users = $sql->query("SELECT * FROM `users`")->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    http_response_code(500);
    $response = array("status" => "error", "message" => $e->getMessage());
    die(json_encode($response));
}

if (!$users) {
    http_response_code(200);
    $response = array("status" => "error", "message" => "no users found");
    die(json_encode($response));
}

http_response_code(200);
$response = array("status" => "success", "message" => count($users) . " user found in database", "data" => $users);
die(json_encode($response));