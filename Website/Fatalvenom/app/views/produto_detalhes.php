<?php
session_start();
include_once("../../database/conexao.php");

$logado_cliente = isset($_SESSION['id_cliente']);
$logado_funcionario = isset($_SESSION['id_funcionario']);
$logado = $logado_cliente || $logado_funcionario;

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
    <link rel="stylesheet" href="../../public/assets/style.css">
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
    <nav class="navbar navbar-expand-lg bg-body p-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../public/assets/imagens/logo.png" alt="Logo" width="500" height="100">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

                <li class="nav-item me-3">
                    <a class="nav-link" href="../../public/index.php">Home</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="carrinho.php">Carrinho</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
    
    <div class="container">
        <div class="product-details">
            <div class="product-image">
                <img src="<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            </div>
            <div class="product-info">
                <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
                <p class="card-text fw-bold text-success mb-3" style="font-size:30px;">
                    R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                </p>
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