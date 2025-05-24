<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

function fetch($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0"); // مهم أحيانًا
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$info = fetch("http://176.97.212.148:30120/info.json");
$players = fetch("http://176.97.212.148:30120/players.json");

if ($info === false || $players === false) {
    http_response_code(500);
    echo json_encode(["error" => "لا يمكن الاتصال بسيرفر FiveM"]);
} else {
    echo json_encode([
        "info" => json_decode($info, true),
        "players" => json_decode($players, true)
    ]);
}
