<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

function fetch($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$info = fetch("http://176.97.212.148:30120/info.json");
$players = fetch("http://176.97.212.148:30120/players.json");

echo "--- info.json ---\n";
var_dump($info);

echo "\n\n--- players.json ---\n";
var_dump($players);
