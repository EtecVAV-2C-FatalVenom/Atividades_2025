<?php
session_start();
include_once("../../database/conexao.php");

$erro = '';
$sucesso = '';
$redirect_url = '';

if (isset($_SESSION['id_funcionario'])) {
    $userId = $_SESSION['id_funcionario'];
    $redirect_url = "painel_funcionario.php";

    $sql_fetch = "SELECT nome FROM funcionarios WHERE id_funcionario = ?";
    $stmt_fetch = $conexao->prepare($sql_fetch);
    $stmt_fetch->bind_param("i", $userId);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $user = $result->fetch_assoc();
    $currentName = $user['nome'] ?? '';
    $stmt_fetch->close();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novoNome = trim($_POST['nome']);

        if (empty($novoNome)) {
            $erro = "O nome não pode ser vazio.";
        } else {
            $sql_update = "UPDATE funcionarios SET nome = ? WHERE id_funcionario = ?";
            $stmt_update = $conexao->prepare($sql_update);
            $stmt_update->bind_param("si", $novoNome, $userId);

            if ($stmt_update->execute()) {
                $sucesso = "Nome atualizado com sucesso!";
                $_SESSION['nome'] = $novoNome;
                $currentName = $novoNome;
            } else {
                $erro = "Erro ao atualizar nome.";
            }
            $stmt_update->close();
        }
    }

    $label = "Novo Nome:";
    $fieldName = "nome";
    $currentValue = $currentName;

} elseif (isset($_SESSION['id_cliente'])) {
    $userId = $_SESSION['id_cliente'];
    $redirect_url = "perfil.php";

    $sql_fetch = "SELECT nickname FROM cliente WHERE id_cliente = ?";
    $stmt_fetch = $conexao->prepare($sql_fetch);
    $stmt_fetch->bind_param("i", $userId);
    $stmt_fetch->execute();
    $result = $stmt_fetch->get_result();
    $user = $result->fetch_assoc();
    $currentNickname = $user['nickname'] ?? '';
    $stmt_fetch->close();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $novoNickname = trim($_POST['nickname']);

        if (empty($novoNickname)) {
            $erro = "O nickname não pode ser vazio.";
        } else {
            $sql_update = "UPDATE cliente SET nickname = ? WHERE id_cliente = ?";
            $stmt_update = $conexao->prepare($sql_update);
            $stmt_update->bind_param("si", $novoNickname, $userId);

            if ($stmt_update->execute()) {
                $sucesso = "Nickname atualizado com sucesso!";
                $_SESSION['nickname'] = $novoNickname;
                $currentNickname = $novoNickname;
            } else {
                $erro = "Erro ao atualizar nickname.";
            }
            $stmt_update->close();
        }
    }

    $label = "Novo Nickname:";
    $fieldName = "nickname";
    $currentValue = $currentNickname;

} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/style.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }

        .card-alterar {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        .card-alterar h3 {
            text-align: center;
            margin-bottom: 25px;
        }

        .card-alterar .btn-group {
            display: flex;
            justify-content: space-between;
        }

        .alert {
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="card-alterar">
    <h3>Alterar <?= isset($_SESSION['id_funcionario']) ? 'Nome' : 'Nickname' ?></h3>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="<?= $fieldName ?>" class="form-label"><?= $label ?></label>
            <input type="text" name="<?= $fieldName ?>" id="<?= $fieldName ?>" 
                   class="form-control" placeholder="<?= htmlspecialchars($currentValue) ?>" required>
        </div>

        <div class="btn-group mt-3">
            <button type="submit" class="btn btn-dark">Atualizar</button>
            <a href="<?= $redirect_url ?>" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>