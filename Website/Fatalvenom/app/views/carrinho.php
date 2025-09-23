<?php
session_start();

include_once(__DIR__ . "/../../model/conexao.php");

$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;
$id_funcionario = isset($_SESSION['id_funcionario']) ? $_SESSION['id_funcionario'] : null;

$logado_cliente = isset($_SESSION['id_cliente']);
$logado_funcionario = isset($_SESSION['id_funcionario']);
$logado = $logado_cliente || $logado_funcionario;

if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = array();

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($acao == 'mais' && $id != 0) {
    if (isset($_SESSION['carrinho'][$id])) $_SESSION['carrinho'][$id]++;
    else $_SESSION['carrinho'][$id] = 1;
}

if ($acao == 'menos' && $id != 0) {
    if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]--;
        if ($_SESSION['carrinho'][$id] <= 0) unset($_SESSION['carrinho'][$id]);
    }
}

if ($acao == 'cancelar') $_SESSION['carrinho'] = array();

$produtos = array();
$total = 0;

if (count($_SESSION['carrinho']) > 0) {
    $ids = implode(",", array_keys($_SESSION['carrinho']));
    $sql = "SELECT * FROM produto WHERE id IN ($ids)";
    $result = mysqli_query($conexao, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantidade'] = $_SESSION['carrinho'][$row['id']];
        $row['subtotal'] = $row['preco'] * $row['quantidade'];
        $total += $row['subtotal'];
        $produtos[] = $row;
    }
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="../../public/assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
            margin: 30px 0;
        }
        .cart-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .cart-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        .cart-details {
            flex-grow: 1;
        }
        .cart-details h5 {
            margin-bottom: 10px;
        }
        .cart-details p {
            margin: 3px 0;
        }
        .cart-actions a {
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            padding: 5px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            margin-right: 5px;
            transition: 0.2s;
        }
        .cart-actions a:hover {
            background-color: #eee;
        }
        .total-section {
            text-align: right;
            font-size: 1.5rem;
            margin-top: 20px;
            font-weight: bold;
        }
        .cart-buttons a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body p-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../public/assets/imagens/logo.png" alt="Logo" width="500" height="100">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-3">
                <?php if ($logado): ?>
                    <?php if ($id_funcionario): ?>
                        <li class="nav-item me-3">
                            <a class="nav-link active" href="painel_funcionario.php">Perfil</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item me-3">
                            <a class="nav-link active" href="perfil.php">Perfil</a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item me-3">
                        <a class="nav-link active" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item me-3"><a class="nav-link" href="../../public/index.php">Home</a></li>
                <li class="nav-item me-3"><a class="nav-link" href="carrinho.php">Carrinho</a></li>
            </ul>
        </div>
    </div>
</nav>

<h1>Seu Carrinho</h1>

<div class="container">
    <?php
    if (count($produtos) > 0) {
        foreach ($produtos as $produto) {
            echo '<div class="cart-card">';
            echo '<img src="'.$produto['imagem'].'" alt="'.$produto['nome'].'">';
            echo '<div class="cart-details">';
            echo '<h5>'.$produto['nome'].' <span class="text-success">R$ '.$produto['preco'].'</span></h5>';
            echo '<p>'.$produto['descricao'].'</p>';
            echo '<p>Quantidade: '.$produto['quantidade'].' | Subtotal: <strong>R$ '.$produto['subtotal'].'</strong></p>';
            echo '<div class="cart-actions">';
            echo '<a href="?acao=mais&id='.$produto['id'].'" class="btn btn-sm btn-outline-primary">+</a>';
            echo '<a href="?acao=menos&id='.$produto['id'].'" class="btn btn-sm btn-outline-primary">-</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p class='text-center'>Seu carrinho está vazio.</p>";
    }
    echo '<div class="total-section">Total: R$ '.$total.'</div>';
    ?>
<div class="cart-buttons mt-3">
    <a href="../../public/index.php" class="btn btn-secondary">Voltar para tela inicial</a>
    <a href="?acao=cancelar" class="btn btn-danger">Limpar Carrinho</a>
    <a href="#" class="btn btn-dark">Comprar</a>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
