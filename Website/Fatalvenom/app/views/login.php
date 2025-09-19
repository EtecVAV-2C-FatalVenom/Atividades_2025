<?php
session_start();
include_once("../../database/conexao.php");


$mensagem = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : '';

    if (empty($email) || empty($senha)) {
        $mensagem = 'Preencha todos os campos.';
    } else {
        $usuario_encontrado = false;

        $sql_func = "SELECT id, email, nome, senha, cargo FROM funcionarios WHERE email = ?";
        $stmt_func = mysqli_prepare($conexao, $sql_func);
        
        if($stmt_func) {
            mysqli_stmt_bind_param($stmt_func, 's', $email);
            mysqli_stmt_execute($stmt_func);
            $resultado_func = mysqli_stmt_get_result($stmt_func);

            if($linha_func = mysqli_fetch_assoc($resultado_func)){
                $usuario_encontrado = true;
                $senha_hash = $linha_func['senha'];

                if(password_verify($senha, $senha_hash)){
                    $_SESSION['id'] = $linha_func['id'];
                    $_SESSION['email'] = $linha_func['email'];
                    $_SESSION['nome'] = $linha_func['nome'];
                    $_SESSION['cargo'] = $linha_func['cargo'];
                    
                    header('Location: painel_funcionario.php');
                    exit();
                }
            }
            mysqli_stmt_close($stmt_func);
        }

        if (!$usuario_encontrado) {
            $sql_cli = "SELECT id, email, senha, nome FROM cliente WHERE email = ?";
            $stmt_cli = mysqli_prepare($conexao, $sql_cli);
            
            if($stmt_cli) {
                mysqli_stmt_bind_param($stmt_cli, 's', $email);
                mysqli_stmt_execute($stmt_cli);
                $resultado_cli = mysqli_stmt_get_result($stmt_cli);

                if($linha_cli = mysqli_fetch_assoc($resultado_cli)){
                    $usuario_encontrado = true;
                    $senha_hash = $linha_cli['senha'];

                    if(password_verify($senha, $senha_hash)){
                        $_SESSION['id'] = $linha_cli['id'];
                        $_SESSION['email'] = $linha_cli['email'];
                        $_SESSION['nome'] = $linha_cli['nome'];

                        header('Location: ../../public/index.php'); // Alterar para redirecionar para o catálogo 
                        exit();
                    }
                }
                mysqli_stmt_close($stmt_cli);
            }
        }
        
        if (!$usuario_encontrado || !isset($_SESSION['id'])) {
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
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Login</h5>
          <form action="login.php" method="post">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="senha" id="senha"placeholder="Senha">
            <input value="Entrar" type="submit" name="entrar" id="entrar" class="btn btn-primary">
            <?php if (!empty($mensagem)) : ?>
                <span><?php echo $mensagem; ?></span>
            <?php endif; ?>
            <a href="cadastrar_usuario.php" class="btn btn-primary">Cadastrar</a>
        </form>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>