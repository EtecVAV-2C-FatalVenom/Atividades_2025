<?php
require "db.php";

$id_cliente = $_GET["id_cliente"] ?? null;

if(!$id_cliente){
    echo json_encode(["status"=>"erro","mensagem"=>"Informe id_cliente"]);
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

echo json_encode($itens);
