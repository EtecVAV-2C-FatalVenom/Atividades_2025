<?php
session_start();
include_once("../../model/conexao.php");

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION['email'])) {
    header("Location: ../views/login.php");
    exit;
}

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$id = null;

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]++;
    } else {
        $_SESSION['carrinho'][$id] = 1;
    }
}

if (isset($_POST['pagina']) && !empty($_POST['pagina'])) {
    $pagina = $_POST['pagina'];

    if (strpos($pagina, '?') !== false) {
        $pagina_redirecionar = $pagina . "&adicionado=" . $id;
    } else {
        $pagina_redirecionar = $pagina . "?adicionado=" . $id;
    }

    header("Location: " . $pagina_redirecionar);
    exit;
}

header("Location: ../../public/index.php");
exit;
?>
