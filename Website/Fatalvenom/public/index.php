<?php
session_start();
include_once("../database/conexao.php");

$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;
$id_funcionario = isset($_SESSION['id_funcionario']) ? $_SESSION['id_funcionario'] : null;

$logado = ($id_cliente || $id_funcionario);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Fatal Venom</title>
</head>
<body>
  
    <nav class="navbar navbar-expand-lg bg-body p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/imagens/logo.png" alt="Logo" width="500" height="100">
            </a>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                    <?php if ($logado): ?>
                        <?php if ($id_funcionario): ?>
                            <li class="nav-item me-3">
                                <a class="nav-link active" href="../app/views/painel_funcionario.php">Perfil</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item me-3">
                                <a class="nav-link active" href="../app/views/perfil.php">Perfil</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item me-3">
                            <a class="nav-link active" href="../app/views/login.php">Login</a>
                        </li>
                    <?php endif; ?>
                    
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#sobre">Sobre</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="../app/views/carrinho.php">Carrinho</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="carrossel">     
        <div id="carouselExampleRide" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/imagens/mural.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/imagens/aespa.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/imagens/galaxg.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/imagens/masc.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/imagens/mugler.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="content2">
    <div class="row">
        <div class="col">
            <div class="card">
                <a href="../app/views/shirts.php" class="card-link">
                    <img src="assets/imagens/tops.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <span>
                            <h5 class="card-title">Partes de cima</h5>
                            <p class="card-text">Jaquetas, blusas, bodies e croppeds da mais alta qualidade: estilo para quem gosta de ousar.</p>
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <a href="../app/views/pants.php" class="card-link">
                    <img src="assets/imagens/calcas.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <span>
                            <h5 class="card-title">Partes de baixo</h5>
                            <p class="card-text">Calças, saias e shorts dos mais variados tamanhos e caimentos para você ousar nas combinações.</p>
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <a href="../app/views/acessories.php" class="card-link">
                    <img src="assets/imagens/acessorios.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <span>
                            <h5 class="card-title">Acessórios</h5>
                            <p class="card-text">Uma variedade de acessórios para dar aquele toque final no seu look - nunca é demais!</p>
                        </span>
                    </div>
                </a>
            </div>
        </div>

    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
