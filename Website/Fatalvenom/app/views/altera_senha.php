<?php
session_start();
include_once("../../database/conexao.php");

if (!isset($_SESSION['id_funcionario']) && !isset($_SESSION['id_cliente'])) {
    header("Location: login.php");
    exit();
}

$is_funcionario = isset($_SESSION['cargo']);
$userId = $is_funcionario ? $_SESSION['id_funcionario'] : $_SESSION['id_cliente'];
$table = $is_funcionario ? "funcionarios" : "cliente";
$field = "senha";


$id_column = $is_funcionario ? "id_funcionario" : "id_cliente";

$redirect_url = $is_funcionario ? "painel_funcionario.php" : "perfil.php";

$erro = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senhaAtual = $_POST['senha_atual'];
    $novaSenha = $_POST['nova_senha'];
    $confirmaSenha = $_POST['confirma_senha'];

    if (strlen($novaSenha) < 6) {
        $erro = "A nova senha deve ter no mínimo 6 caracteres.";
    } elseif ($novaSenha !== $confirmaSenha) {
        $erro = "As senhas não coincidem.";
    } else {
        $sql = "SELECT $field FROM $table WHERE $id_column = ?";
        $stmt = $conexao->prepare($sql);
        
        if ($stmt === false) {
            $erro = "Erro ao preparar a consulta: " . $conexao->error;
        } else {
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user && password_verify($senhaAtual, $user[$field])) {
                $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
                
                $sqlUpdate = "UPDATE $table SET $field = ? WHERE $id_column = ?";
                $stmtUpdate = $conexao->prepare($sqlUpdate);
                
                if ($stmtUpdate === false) {
                    $erro = "Erro ao preparar a atualização: " . $conexao->error;
                } else {
                    $stmtUpdate->bind_param("si", $novaSenhaHash, $userId);
                    
                    if ($stmtUpdate->execute()) {
                        $sucesso = "Senha alterada com sucesso!";
                    } else {
                        $erro = "Erro ao atualizar a senha: " . $stmtUpdate->error;
                    }
                    $stmtUpdate->close();
                }
            } else {
                $erro = "Senha atual incorreta.";
            }
        }
        $stmt->close();
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
        <a href="<?= $redirect_url ?>" class="btn btn-secondary">Voltar</a>
    </form>
</body>
</html>