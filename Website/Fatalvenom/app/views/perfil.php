<?php
session_start();

if (!isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['id_funcionario'])) {
    header("Location: painel_funcionario.php");
    exit();
}

$name = isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'Nome do Usuário';
$mail = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Email do Usuário';

include_once("../../database/conexao.php"); 

$userId = $_SESSION['id_cliente'];

$sql = "SELECT nome, nickname, email, telefone, senha FROM cliente WHERE id_cliente = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$avatar = !empty($user['avatar']) ? $user['avatar'] : "https://i.pravatar.cc/150";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }

        .perfil-card {
            max-width: 700px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .perfil-card h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .campo {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .campo-label {
            width: 120px;
            font-weight: bold;
        }

        .campo-valor {
            flex: 1;
        }

        .campo button {
            margin-left: 10px;
        }

        .perfil-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .profilepic {
            text-align: center;       
            margin-bottom: 20px;      
        }

        .profilepic img {
            width: 150px;             
            height: 150px;            
            border-radius: 50%;       
            object-fit: cover;        
            display: inline-block;    
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../public/assets/imagens/logo.png" alt="Logo" width="500" height="100">
            </a>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
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

<div class="perfil-card">
    <div class="profilepic">
        <img src="../../public/assets/imagens/profile.png" alt="foto de perfil">
    </div>

    <h2><strong>Meu Perfil</strong></h2>

    <div class="campo">
        <div class="campo-label">Nome:</div>
        <div class="campo-valor"><?= htmlspecialchars($user['nome']) ?></div>
    </div>

    <div class="campo">
        <div class="campo-label">Nickname:</div>
        <div class="campo-valor"><?= htmlspecialchars($user['nickname']) ?></div>
        <button class="btn btn-secondary" onclick="window.location.href='altera_nickname.php'">Alterar Nickname</button>
    </div>

    <div class="campo">
        <div class="campo-label">Email:</div>
        <div class="campo-valor"><?= htmlspecialchars($user['email']) ?></div>
    </div>

    <div class="campo">
        <div class="campo-label">Senha:</div>
        <div class="campo-valor">********</div>
        <button class="btn btn-secondary" onclick="window.location.href='altera_senha.php'">Alterar Senha</button>
    </div>

    <div class="campo">
        <div class="campo-label">Telefone:</div>
        <div class="campo-valor"><?= htmlspecialchars($user['telefone']) ?></div>
    </div>

    <div class="perfil-actions">
        <a href="../../public/index.php" class="btn btn-dark">Voltar para a tela inicial</a>
        <a href="../controllers/logout.php" class="btn btn-danger">Sair</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
