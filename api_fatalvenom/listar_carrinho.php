<?php
require "db.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

$id_cliente = $_GET["id_cliente"] ?? null;

if(!$id_cliente){
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Informe id_cliente"
    ]);
    exit;
}

$sql = $pdo->prepare("
    SELECT 
        c.id,
        c.quantidade,
        p.id AS produto_id,
        p.nome,
        p.preco,
        p.imagem,
        p.categoria
    FROM carrinho c
    JOIN produto p ON p.id = c.id_produto
    WHERE c.id_cliente = ?
");
$sql->execute([$id_cliente]);

$itens = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "status" => "ok",
    "itens"  => $itens
]);
exit;
