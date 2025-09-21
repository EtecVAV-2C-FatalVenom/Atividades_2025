<?php
session_start();
include_once("../../database/conexao.php");

$mensagem = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $nickname = $_POST['nickname'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirma_senha = $_POST['confirma_senha'] ?? '';

    if (empty($nome) || empty($nickname) || empty($email) || empty($telefone) || empty($senha) || empty($confirma_senha)) {
        $mensagem = 'Por favor, preencha todos os campos.';
    } elseif (strlen($senha) < 6) { 
        $mensagem = 'A senha deve ter pelo menos 6 caracteres.';
    } elseif ($senha !== $confirma_senha) {
        $mensagem = 'As senhas não coincidem.';
    } else {
        $sql_verifica = "SELECT id_cliente FROM cliente WHERE email = ?";
        $stmt_verifica = mysqli_prepare($conexao, $sql_verifica);
        mysqli_stmt_bind_param($stmt_verifica, 's', $email);
        mysqli_stmt_execute($stmt_verifica);
        mysqli_stmt_store_result($stmt_verifica);

        if (mysqli_stmt_num_rows($stmt_verifica) > 0) {
            $mensagem = 'Este e-mail já está cadastrado.';
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql_insere = "INSERT INTO cliente (nome, nickname, email, telefone, senha) VALUES (?, ?, ?, ?, ?)";
            $stmt_insere = mysqli_prepare($conexao, $sql_insere);
            mysqli_stmt_bind_param($stmt_insere, 'sssss', $nome, $nickname, $email, $telefone, $senha_hash);

            if (mysqli_stmt_execute($stmt_insere)) {
                $mensagem = 'Cadastro realizado com sucesso!';
            } else {
                $mensagem = 'Erro ao cadastrar. Tente novamente.';
            }

            mysqli_stmt_close($stmt_insere);
        }
        mysqli_stmt_close($stmt_verifica);
    }
}

include(__DIR__ . '/../views/cadastrar_usuario.php');
?>