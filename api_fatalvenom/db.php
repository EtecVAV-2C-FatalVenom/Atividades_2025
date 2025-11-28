<?php
header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

$host = "localhost";
$db = "fatalvenom";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Falha na conexão"]);
    exit;
}
