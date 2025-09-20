<?php
session_start();
include_once("../../database/conexao.php");

$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'Acessorios';

$logado_cliente = isset($_SESSION['id_cliente']);
$logado_funcionario = isset($_SESSION['id_funcionario']);
$logado = $logado_cliente || $logado_funcionario;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title><?php echo $categoria; ?> - Fatal Venom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold text-uppercase" href="#"><?php echo $categoria; ?> - Fatal Venom</a>
    <div class="ms-auto">
        <?php 
        if ($logado_funcionario) {
            echo '<a class="btn btn-outline-light me-2" href="painel_funcionario.php">Perfil Funcionário</a>';
            echo '<a href="carrinho.php" class="btn btn-warning">Carrinho</a>';
        } elseif ($logado_cliente) {
            echo '<a class="btn btn-outline-light me-2" href="perfil.php">Perfil Cliente</a>';
            echo '<a href="carrinho.php" class="btn btn-warning">Carrinho</a>';
        } else {
            echo '<a class="btn btn-outline-light me-2" href="login.php">Login</a>';
        }
        ?>
        <a href="../../public/index.php" class="btn btn-warning">Voltar</a>
    </div>
</nav>

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
            echo '<div class="col-md-4">';
            echo '<div class="card shadow-sm h-100">';
            echo '<a href="produto_detalhes.php?id='.$produto['id'].'">';
            echo '<img src="'.$produto['imagem'].'" class="card-img-top" alt="'.$produto['nome'].'" style="height:250px; object-fit:cover;">';
            echo '</a>';
            echo '<div class="card-body d-flex flex-column">';
            echo '<a href="../app/views/produto_detalhes.php?id='.$produto['id'].'" class="text-decoration-none text-dark">';
            echo '<h5 class="card-title">'.$produto['nome'].'</h5>';
            echo '</a>';
            echo '<p class="card-text fw-bold text-success mb-3">R$ '.$produto['preco'].'</p>';
            echo '<form method="POST" action="../controllers/adicionar_carrinho.php" class="mt-auto">';
            echo '<input type="hidden" name="id" value="'.$produto['id'].'">';
            echo '<input type="hidden" name="pagina" value="'.$_SERVER['REQUEST_URI'].'">';
            echo '<button type="submit" class="btn btn-dark w-100">Adicionar ao Carrinho</button>';
            echo '</form>';
            echo '</div></div></div>';
        }
    } else {
        echo '<p class="text-center">Nenhum produto disponível nesta categoria.</p>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexao);
    ?>
    </div>
</div>

</body>
</html>