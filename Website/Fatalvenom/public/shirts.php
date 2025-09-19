<?php
session_start();
include_once("../database/conexao.php");


$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'Camisa';
?>
<!DOCTYPE html>
<html lang="pt-br">
<meta charset="utf-8">
<head>
    <link rel="stylesheet" href="Produtos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="header">
        <h1 class="title"><?php echo ucfirst($categoria); ?> - Fatal Venom</h1>

        <div class="header-buttons">
            <button class="btn btn-primary">Login</button>
            <button class="btn btn-outline-light">Carrinho</button>
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
                    <img src='{$produto['imagem']}' alt='{$produto['nome']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$produto['nome']}</h5>
                        <p class='card-text'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                        <form method='POST' action='carrinho.php'>
                            <input type='hidden' name='id' value='{$produto['id']}'>
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
