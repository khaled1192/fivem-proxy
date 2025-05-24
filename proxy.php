<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = @file_get_contents("http://176.97.212.148:30120/info.json");

if ($data === FALSE) {
    http_response_code(500);
    echo json_encode(["error" => "لا يمكن الاتصال بسيرفر FiveM"]);
} else {
    echo $data;
}
