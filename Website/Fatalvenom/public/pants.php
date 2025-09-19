<?php
session_start();
include_once("../database/conexao.php");

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'Calça';

$logado = isset($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo ucfirst($categoria); ?> - Fatal Venom</title>
    <link rel="stylesheet" href="Produtos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="header">
        <h1 class="title"><?php echo ucfirst($categoria); ?> - Fatal Venom</h1>

        <div class="header-buttons">
            <?php if ($logado): ?>
                <a class="btn btn-outline-light" href="perfil.php">Perfil</a>
            <?php else: ?>
                <a class="btn btn-outline-light" href="../app/views/login.php">Login</a>
            <?php endif; ?>
            <a href="../app/views/carrinho.php" class="btn btn-outline-light">Carrinho</a>
        </div>
    </div>

    <div class="produtos">
        <?php
        $sql = "SELECT id, nome, preco, imagem FROM produto WHERE categoria = ?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "s", $categoria);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($produto = mysqli_fetch_assoc($result)) {
                echo "
                <div class='card'>
                    <a href='../app/views/produto_detalhes.php?id={$produto['id']}'>
                        <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                    </a>
                    <div class='card-body'>
                        <a href='../app/views/produto_detalhes.php?id={$produto['id']}'>
                            <h5 class='card-title'>{$produto['nome']}</h5>
                        </a>
                        <p class='card-text'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                        <form method='POST' action='../app/controllers/adicionar_carrinho.php'>
                            <input type='hidden' name='id' value='{$produto['id']}'>
                            <input type='hidden' name='pagina' value='{$_SERVER['REQUEST_URI']}'>
                            <button type='submit' class='btn btn-dark'>Adicionar ao Carrinho</button>
                        </form>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<p>Nenhum produto disponível nesta categoria.</p>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
        ?>
    </div>
</body>
</html>
