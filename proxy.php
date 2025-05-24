<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

function fetch($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    
    // نجعل الطلب يشبه المتصفح
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Accept: application/json",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)",
        "Connection: keep-alive"
    ]);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);

    // لمعرفة إذا فيه خطأ
    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch);
    }

    curl_close($ch);
    return $response;
}

$data = json_decode(file_get_contents("http://176.97.212.148:30120/info.json"), true);
echo "عدد اللاعبين: " . $data["clients"];

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
