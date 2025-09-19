<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$name = isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'Nome do Usuário';
$mail = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Email do Usuário';

include_once("../database/conexao.php"); 
$userId = $_SESSION['id'];

$sql = "SELECT nome, nickname, email, telefone, senha FROM cliente WHERE id = ?";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .perfil-container {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            padding: 40px;
        }
        .avatar-section {
            text-align: center;
        }
        .avatar-section img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .dados-usuario {
            flex: 1;
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
    </style>
</head>
<body>
    <div class="perfil-container">
        <div class="dados-usuario">
            <div class="campo">
                <div class="campo-label">Nome:</div>
                <div class="campo-valor"><?= htmlspecialchars($user['nome']) ?></div>
            </div>
            <div class="campo">
                <div class="campo-label">Nickname:</div>
                <div class="campo-valor"><?= htmlspecialchars($user['nickname']) ?></div>
                <button class="btn btn-sm btn-warning" onclick="window.location.href='altera_nickname.php'">Alterar Nickname</button>
            </div>
            <div class="campo">
                <div class="campo-label">Email:</div>
                <div class="campo-valor"><?= htmlspecialchars($user['email']) ?></div>
            </div>
            <div class="campo">
                <div class="campo-label">Senha:</div>
                <div class="campo-valor">********</div>
                <button class="btn btn-sm btn-warning" onclick="window.location.href='altera_senha.php'">Alterar Senha</button>
            </div>
            <div class="campo">
                <div class="campo-label">Telefone:</div>
                <div class="campo-valor"><?= htmlspecialchars($user['telefone']) ?></div>
            </div>
            <a href="../app/controllers/logout.php" class="btn btn-danger mt-2">Sair</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
