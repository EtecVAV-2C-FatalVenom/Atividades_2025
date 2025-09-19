<?php
session_start();
include_once("../../database/conexao.php"); 

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if (isset($_GET['acao'])) {
    $id = intval($_GET['id']);

    if ($_GET['acao'] == 'mais') {
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]++;
        } else {
            $_SESSION['carrinho'][$id] = 1;
        }
    }

    if ($_GET['acao'] == 'menos') {
        if (isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id]--;
            if ($_SESSION['carrinho'][$id] <= 0) {
                unset($_SESSION['carrinho'][$id]);
            }
        }
    }

    if ($_GET['acao'] == 'cancelar') {
        $_SESSION['carrinho'] = [];
    }
}

$produtos = [];
$total = 0;

if (count($_SESSION['carrinho']) > 0) {
    $ids = implode(",", array_keys($_SESSION['carrinho']));
    $sql = "SELECT * FROM produtos WHERE id IN ($ids)";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $row['quantidade'] = $_SESSION['carrinho'][$row['id']];
        $row['subtotal'] = $row['preco'] * $row['quantidade'];
        $total += $row['subtotal'];
        $produtos[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .produto {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
        }
        .botoes {
            margin-top: 10px;
        }
        .botoes a {
            text-decoration: none;
            background: #333;
            color: white;
            padding: 5px 10px;
            margin-right: 5px;
            border-radius: 5px;
        }
        .acoes-finais {
            margin-top: 20px;
        }
        .acoes-finais a {
            text-decoration: none;
            background: darkred;
            color: white;
            padding: 10px 15px;
            margin-right: 10px;
            border-radius: 5px;
        }
        .acoes-finais .pagar {
            background: green;
        }
    </style>
</head>
<body>
    <h1>Seu Carrinho</h1>

    <?php if (count($produtos) > 0): ?>
        <?php foreach ($produtos as $p): ?>
            <div class="produto">
                <h3><?= $p['nome'] ?> (R$ <?= number_format($p['preco'], 2, ',', '.') ?>)</h3>
                <p><?= $p['descricao'] ?></p>
                <p><strong>Quantidade:</strong> <?= $p['quantidade'] ?> </p>
                <p><strong>Subtotal:</strong> R$ <?= number_format($p['subtotal'], 2, ',', '.') ?></p>
                <div class="botoes">
                    <a href="carrinho.php?acao=mais&id=<?= $p['id'] ?>"> + </a>
                    <a href="carrinho.php?acao=menos&id=<?= $p['id'] ?>"> - </a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>

    <h2>Total: R$ <?= number_format($total, 2, ',', '.') ?></h2>
    <div class="acoes-finais">
        <a href="#" class="pagar">Comprar</a>
        <a href="carrinho.php?acao=cancelar">Limpar Carrinho</a>
    </div>
</body>
</html>
