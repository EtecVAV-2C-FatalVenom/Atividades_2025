<?php
require "db.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

$inputJSON = file_get_contents("php://input");
$input = json_decode($inputJSON, true);

$id_cliente = $_POST["id_cliente"] ?? ($input["id_cliente"] ?? null);
$id_produto = $_POST["id_produto"] ?? ($input["id_produto"] ?? null);
$quantidade = $_POST["quantidade"] ?? ($input["quantidade"] ?? 1);

if (!$id_cliente || !$id_produto) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Dados incompletos"
    ]);
    exit;
}

$checkProduto = $pdo->prepare("SELECT id FROM produto WHERE id = ?");
$checkProduto->execute([$id_produto]);

if ($checkProduto->rowCount() == 0) {
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Produto inexistente"
    ]);
    exit;
}

$check = $pdo->prepare("
    SELECT quantidade 
    FROM carrinho 
    WHERE id_cliente = ? AND id_produto = ?
");
$check->execute([$id_cliente, $id_produto]);

if ($check->rowCount() > 0) {
    $update = $pdo->prepare("
        UPDATE carrinho 
        SET quantidade = quantidade + ? 
        WHERE id_cliente = ? AND id_produto = ?
    ");
    $update->execute([$quantidade, $id_cliente, $id_produto]);

    echo json_encode([
        "status" => "ok",
        "mensagem" => "Quantidade atualizada"
    ]);
    exit;
}

$insert = $pdo->prepare("
    INSERT INTO carrinho(id_cliente, id_produto, quantidade)
    VALUES (?,?,?)
");
$insert->execute([$id_cliente, $id_produto, $quantidade]);

echo json_encode([
    "status" => "ok",
    "mensagem" => "Adicionado ao carrinho"
]);
exit;
