<?php
session_start();
include_once("../../database/conexao.php");

$logado = isset($_SESSION['id']);

$produto_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($produto_id <= 0) {
    header("Location: Produtos.php");
    exit();
}

$sql = "SELECT id, nome, preco, descricao, imagem, categoria FROM produto WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $produto_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$produto = mysqli_fetch_assoc($result);

if (!$produto) {
    echo "<p>Produto não encontrado.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($produto['nome']); ?> - Fatal Venom</title>
    <link rel="stylesheet" href="Produtos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>

        body {
            background-color: #121212;
            color: #fff;
        }
        .container {
            margin-top: 50px;
        }
        .product-details {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: flex-start;
        }
        .product-image {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        .product-info {
            flex: 2;
        }
        .product-info h1 {
            color: #e0e0e0;
        }
        .product-info .price {
            font-size: 2em;
            color: #00ff00;
            margin: 20px 0;
        }
        .product-info .description {
            color: #b0b0b0;
            line-height: 1.6;
        }
        .add-to-cart-form {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title"><?php echo htmlspecialchars(ucfirst($produto['categoria'])); ?> - Fatal Venom</h1>

        <div class="header-buttons">
            <?php if ($logado): ?>
                <a class="btn btn-outline-light" href="../../public/perfil.php">Perfil</a>
            <?php else: ?>
                <a class="btn btn-outline-light" href="../login.php">Login</a>
            <?php endif; ?>
            <a href="carrinho.php" class="btn btn-outline-light">Carrinho</a>
        </div>
    </div>
    
    <div class="container">
        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            </div>
            <div class="product-info">
                <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
                <p class="price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <p class="description"><?php echo htmlspecialchars($produto['descricao']); ?></p>

                <div class="add-to-cart-form">
                    <form method="POST" action="../controllers/adicionar_carrinho.php">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">
                        <input type="hidden" name="pagina" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
                        <button type="submit" class="btn btn-dark">Adicionar ao Carrinho</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    ?>
</body>
</html>