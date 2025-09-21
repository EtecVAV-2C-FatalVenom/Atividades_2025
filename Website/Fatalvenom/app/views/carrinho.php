<?php
session_start();
include_once(__DIR__ . "/../../database/conexao.php");

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
</head>
<body>
<h1>Seu Carrinho</h1>

<?php
if (count($produtos) > 0) {
    for ($i=0; $i<count($produtos); $i++) {
        echo "<div>";
        echo "<h3>".$produtos[$i]['nome']." (R$ ".$produtos[$i]['preco'].")</h3>";
        echo "<p>".$produtos[$i]['descricao']."</p>";
        echo "<p>Quantidade: ".$produtos[$i]['quantidade']."</p>";
        echo "<p>Subtotal: R$ ".$produtos[$i]['subtotal']."</p>";
        echo "<a href='?acao=mais&id=".$produtos[$i]['id']."'> + </a> ";
        echo "<a href='?acao=menos&id=".$produtos[$i]['id']."'> - </a>";
        echo "</div><hr>";
    }
} else {
    echo "<p>Seu carrinho está vazio.</p>";
}

echo "<h2>Total: R$ ".$total."</h2>";
?>
<a href="../../public/index.php" class="btn btn-dark mt-2">Voltar para tela inicial</a>
<a href="?acao=cancelar">Limpar Carrinho</a>
<a href="#">Comprar</a>
</body>
</html>
