<?php
session_start();
include_once("../database/conexao.php"); 

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['id'];
$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNickname = trim($_POST['nickname']);

    if (empty($novoNickname)) {
        $erro = "O nickname não pode ser vazio.";
    } else {
        $sql = "UPDATE cliente SET nickname = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("si", $novoNickname, $userId);

        if ($stmt->execute()) {
            $sucesso = "Nickname atualizado com sucesso!";
            $_SESSION['nickname'] = $novoNickname; // atualiza sessão
        } else {
            $erro = "Erro ao atualizar nickname.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Nickname</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3>Alterar Nickname</h3>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="nickname" class="form-label">Novo Nickname:</label>
            <input type="text" name="nickname" id="nickname" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="perfil.php" class="btn btn-secondary">Voltar</a>
    </form>
</body>
</html>
