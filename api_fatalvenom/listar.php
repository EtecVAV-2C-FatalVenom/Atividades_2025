<?php
require "db.php";

$sql = $pdo->query("SELECT id, nome, descricao, preco, imagem, estoque, categoria FROM produto");
$produtos = $sql->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($produtos);
