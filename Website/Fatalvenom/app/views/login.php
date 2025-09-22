<?php
session_start();
include_once("../../database/conexao.php");

$mensagem = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : '';

    if (empty($email) || empty($senha)) {
        $mensagem = 'Preencha todos os campos.';
    } else {

        $sql_func = "SELECT id_funcionario, email, nome, senha, cargo FROM funcionarios WHERE email = ?";
        $stmt_func = mysqli_prepare($conexao, $sql_func);
        $usuario_autenticado = false;

        if ($stmt_func) {
            mysqli_stmt_bind_param($stmt_func, 's', $email);
            mysqli_stmt_execute($stmt_func);
            $resultado_func = mysqli_stmt_get_result($stmt_func);

            if ($linha_func = mysqli_fetch_assoc($resultado_func)) {
                if (password_verify($senha, $linha_func['senha'])) {

                    $_SESSION['id_funcionario'] = $linha_func['id_funcionario'];
                    $_SESSION['email'] = $linha_func['email'];
                    $_SESSION['nome'] = $linha_func['nome'];
                    $_SESSION['cargo'] = $linha_func['cargo'];

                    $usuario_autenticado = true;
                    header('Location: painel_funcionario.php');
                    exit();
                }
            }
            mysqli_stmt_close($stmt_func);
        }

        if (!$usuario_autenticado) {
            $sql_cli = "SELECT id_cliente, email, senha, nome FROM cliente WHERE email = ?";
            $stmt_cli = mysqli_prepare($conexao, $sql_cli);

            if ($stmt_cli) {
                mysqli_stmt_bind_param($stmt_cli, 's', $email);
                mysqli_stmt_execute($stmt_cli);
                $resultado_cli = mysqli_stmt_get_result($stmt_cli);

                if ($linha_cli = mysqli_fetch_assoc($resultado_cli)) {
                    if (password_verify($senha, $linha_cli['senha'])) {
                        $_SESSION['id_cliente'] = $linha_cli['id_cliente'];
                        $_SESSION['email'] = $linha_cli['email'];
                        $_SESSION['nome'] = $linha_cli['nome'];

                        $usuario_autenticado = true;
                        header('Location: ../../public/index.php');
                        exit();
                    }
                }
                mysqli_stmt_close($stmt_cli);
            }
        }

        if (!$usuario_autenticado) {
            session_unset();
            session_destroy();
            $mensagem = 'Email ou senha incorretos.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .logo-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-section img {
            width: 400pxpx;
            height: 80px;
            object-fit: contain;
        }
    </style>
    <link rel="stylesheet" href="../../public/assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 700px;">
        <div class="card-body">
            <div class="logo-section">
                <img src="../../public/assets/imagens/logo.png" alt="Logo da Loja">
            </div>

            <h5 class="card-title text-center mb-4">Login</h5>
            <form action="login.php" method="post" class="d-flex flex-column gap-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                <input value="Entrar" type="submit" name="entrar" id="entrar" class="btn btn-dark">
                <?php if (!empty($mensagem)) : ?>
                    <div class="text-danger text-center"><?php echo $mensagem; ?></div>
                <?php endif; ?>
                <a href="cadastrar_usuario.php" class="btn btn-secondary mt-2 text-white">Cadastrar</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

