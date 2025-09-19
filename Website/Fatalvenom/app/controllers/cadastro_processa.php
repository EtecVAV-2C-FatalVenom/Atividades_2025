<?php
session_start();
include_once("../../database/conexao.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $confirma_senha = isset($_POST['confirma_senha']) ? $_POST['confirma_senha'] : '';

    if (empty($nome) || empty($email) || empty($senha) || empty($confirma_senha)) {
        header("Location: cadastro.php?erro=campos_vazios");
        exit();
    } elseif ($senha !== $confirma_senha) {
        header("Location: cadastro.php?erro=senhas_nao_coincidem");
        exit();
    } else {
        $sql_verifica = "SELECT id FROM cliente WHERE email = ?";
        $stmt_verifica = mysqli_prepare($conexao, $sql_verifica);
        mysqli_stmt_bind_param($stmt_verifica, 's', $email);
        mysqli_stmt_execute($stmt_verifica);
        mysqli_stmt_store_result($stmt_verifica);

        if (mysqli_stmt_num_rows($stmt_verifica) > 0) {
            header("Location: cadastro.php?erro=email_existe");
            exit();
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql_insere = "INSERT INTO cliente (nome, nickname, email, telefone, senha) VALUES (?, ?, ?, ?, ?)";
            $stmt_insere = mysqli_prepare($conexao, $sql_insere);
            mysqli_stmt_bind_param($stmt_insere, 'sssss', $nome, $nickname, $email, $telefone, $senha_hash);

            if (mysqli_stmt_execute($stmt_insere)) {
                header("Location: ../views/login.php?cadastro_sucesso=true");
                exit();
            } else {
                header("Location: ../views/cadastrar_usuario.php?erro=falha_cadastro");
                exit();
            }

            mysqli_stmt_close($stmt_insere);
        }
        mysqli_stmt_close($stmt_verifica);
    }
}