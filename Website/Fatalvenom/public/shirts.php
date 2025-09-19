<?php
session_start();
include_once("../database/conexao.php");

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'Camisa';
$logado = isset($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo ucfirst($categoria); ?> - Fatal Venom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand fw-bold text-uppercase" href="#">
            <?php echo ucfirst($categoria); ?> - Fatal Venom
        </a>
        <div class="ms-auto">
            <?php if ($logado): ?>
                <a class="btn btn-outline-light me-2" href="perfil.php">Perfil</a>
            <?php else: ?>
                <a class="btn btn-outline-light me-2" href="../app/views/login.php">Login</a>
            <?php endif; ?>
            <a href="../app/views/carrinho.php" class="btn btn-warning">Carrinho</a>
        </div>
    </nav>

    <!-- Produtos -->
    <div class="container my-5">
        <div class="row g-4">
            <?php
            $sql = "SELECT id, nome, preco, imagem FROM produto WHERE categoria = ?";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "s", $categoria);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($produto = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='col-md-4'>
                        <div class='card shadow-sm h-100'>
                            <a href='../app/views/produto_detalhes.php?id={$produto['id']}'>
                                <img src='{$produto['imagem']}' class='card-img-top' alt='{$produto['nome']}' style='height:250px; object-fit:cover;'>
                            </a>
                            <div class='card-body d-flex flex-column'>
                                <a href='../app/views/produto_detalhes.php?id={$produto['id']}' class='text-decoration-none text-dark'>
                                    <h5 class='card-title'>{$produto['nome']}</h5>
                                </a>
                                <p class='card-text fw-bold text-success mb-3'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                                <form method='POST' action='../app/controllers/adicionar_carrinho.php' class='mt-auto'>
                                    <input type='hidden' name='id' value='{$produto['id']}'>
                                    <input type='hidden' name='pagina' value='{$_SERVER['REQUEST_URI']}'>
                                    <button type='submit' class='btn btn-dark w-100'>Adicionar ao Carrinho</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<p class='text-center'>Nenhum produto disponível nesta categoria.</p>";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conexao);
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
