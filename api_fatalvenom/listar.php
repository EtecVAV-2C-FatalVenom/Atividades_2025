<?php
require "db.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

$sql = $pdo->query("
    SELECT id, nome, descricao, preco, imagem, estoque, categoria
    FROM produto
");

$produtos = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => "ok",
    "produtos" => $produtos
]);
exit;
