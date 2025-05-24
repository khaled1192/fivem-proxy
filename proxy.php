<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

function fetch($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Accept: application/json",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
        "Connection: keep-alive"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$infoRaw = fetch("http://176.97.212.148:30120/info.json");
$playersRaw = fetch("http://176.97.212.148:30120/players.json");

if ($infoRaw === false || $playersRaw === false) {
    http_response_code(500);
    echo json_encode(["error" => "لا يمكن الاتصال بسيرفر FiveM"]);
    exit;
}

$info = json_decode($infoRaw, true);
$players = json_decode($playersRaw, true);

echo json_encode([
    "playersCount" => $info["clients"] ?? 0,
    "maxPlayers" => $info["sv_maxclients"] ?? 0,
    "players" => $players,
    "server" => $info
]);
