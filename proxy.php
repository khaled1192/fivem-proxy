<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$info = @file_get_contents("http://176.97.212.148:30120/info.json");
$players = @file_get_contents("http://176.97.212.148:30120/players.json");

if ($info === FALSE || $players === FALSE) {
    http_response_code(500);
    echo json_encode(["error" => "لا يمكن الاتصال بسيرفر FiveM"]);
} else {
    echo json_encode([
        "info" => json_decode($info, true),
        "players" => json_decode($players, true)
    ]);
}
