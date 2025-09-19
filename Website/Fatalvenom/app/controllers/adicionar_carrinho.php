<?php
session_start();
include_once(__DIR__ . "/../../database/conexao.php");

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]++;
    } else {
        $_SESSION['carrinho'][$id] = 1;
    }
}

$pagina = isset($_POST['pagina']) ? $_POST['pagina'] : '/Site2025/Atividades_2025/Website/Fatalvenom/public/shirts.php';
header("Location: $pagina");
exit;
