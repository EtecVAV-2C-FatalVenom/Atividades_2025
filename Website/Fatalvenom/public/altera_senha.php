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
    $senhaAtual = $_POST['senha_atual'];
    $novaSenha = $_POST['nova_senha'];
    $confirmaSenha = $_POST['confirma_senha'];

    if ($novaSenha !== $confirmaSenha) {
        $erro = "As senhas não coincidem.";
    } else {
        // Verifica senha atual
        $sql = "SELECT senha FROM cliente WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!password_verify($senhaAtual, $user['senha'])) {
            $erro = "Senha atual incorreta.";
        } else {
            $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $sqlUpdate = "UPDATE cliente SET senha = ? WHERE id = ?";
            $stmtUpdate = $conexao->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $novaSenhaHash, $userId);

            if ($stmtUpdate->execute()) {
                $sucesso = "Senha alterada com sucesso!";
            } else {
                $erro = "Erro ao atualizar a senha.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h3>Alterar Senha</h3>

    <?php if ($erro): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>
    <?php if ($sucesso): ?>
        <div class="alert alert-success"><?= $sucesso ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="senha_atual" class="form-label">Senha Atual:</label>
            <input type="password" name="senha_atual" id="senha_atual" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nova_senha" class="form-label">Nova Senha:</label>
            <input type="password" name="nova_senha" id="nova_senha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="confirma_senha" class="form-label">Confirme a Nova Senha:</label>
            <input type="password" name="confirma_senha" id="confirma_senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Alterar Senha</button>
        <a href="perfil.php" class="btn btn-secondary">Voltar</a>
    </form>
</body>
</html>
