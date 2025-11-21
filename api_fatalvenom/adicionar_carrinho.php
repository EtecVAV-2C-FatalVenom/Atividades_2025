<?php
require "db.php";

$id_cliente = $_POST["id_cliente"] ?? null;
$id_produto = $_POST["id_produto"] ?? null;
$quantidade = $_POST["quantidade"] ?? 1;

if(!$id_cliente || !$id_produto){
    echo json_encode(["status"=>"erro","mensagem"=>"Dados incompletos"]);
    exit;
}

$sql = $pdo->prepare("INSERT INTO carrinho(id_cliente, id_produto, quantidade) VALUES (?,?,?)");
$sql->execute([$id_cliente, $id_produto, $quantidade]);

echo json_encode(["status"=>"ok","mensagem"=>"Adicionado ao carrinho"]);
