<?php
session_start();
include_once("../../database/conexao.php");

if (!isset($_SESSION['id_funcionario']) || !in_array($_SESSION['cargo'], ['Administrador', 'Gerente'])) {
    echo '<div style="display:flex;justify-content:center;align-items:center;height:100vh;background:#f8d7da;">
            <div style="background:#fff;border:1px solid #f5c2c7;padding:40px 60px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.08);text-align:center;">
                <h2 style="color:#842029;margin-bottom:16px;">Acesso Negado</h2>
                <p style="color:#842029;font-size:18px;">Você não tem permissão para acessar esta página.</p>
                <a href="../../public/index.php" style="margin-top:20px;display:inline-block;padding:8px 24px;background:#842029;color:#fff;border-radius:5px;text-decoration:none;">Voltar para o início</a>
            </div>
        </div>';
    exit;
}

$erro = '';

if (isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nickname = $_POST['nickname'];
    $senha = $_POST['senha'];

    if (strlen($senha) >= 6) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO cliente (nome, email, nickname, senha) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $nome, $email, $nickname, $senha_hash);
        mysqli_stmt_execute($stmt);
    } else {
        $erro = 'A nova senha deve ter no mínimo 6 caracteres.';
    }
}

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];
    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_cliente);
    mysqli_stmt_execute($stmt);
}

if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    $id_cliente = $_POST['id_cliente'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nickname = $_POST['nickname'];

    if (!empty($_POST['senha'])) {
        $senha = $_POST['senha'];
        if (strlen($senha) >= 6) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "UPDATE cliente SET nome=?, email=?, nickname=?, senha=? WHERE id_cliente=?";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "ssssi", $nome, $email, $nickname, $senha_hash, $id_cliente);
        } else {
            $erro = 'A nova senha deve ter no mínimo 6 caracteres.';
        }
    } else {
        $sql = "UPDATE cliente SET nome=?, email=?, nickname=? WHERE id_cliente=?";
        $stmt = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $nome, $email, $nickname, $id_cliente);
    }

    if (empty($erro) && isset($stmt)) {
        mysqli_stmt_execute($stmt);
    }
}

$sql = "SELECT * FROM cliente ORDER BY id_cliente DESC";
$result = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../public/assets/style.css">
</head>
<style>
     .logo-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-section img {
            width: 400px;
            height: 80px;
            object-fit: contain;
        }
</style>
<body class="bg-light">

<div class="logo-section">
    <img src="../../public/assets/imagens/logo.png" alt="Logo da Loja">
</div>

<div class="container my-5">
    <h1 class="mb-4"><a href="painel_funcionario.php" class="btn btn-dark w-100">Voltar</a></h1>
    <h1 class="mb-4">Gerenciar Clientes<div class="col-md-1"></h1>
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $erro; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4 p-3" style="height:150px;">
        <h5>Adicionar Cliente</h5> 
        <form method="POST">
            <input type="hidden" name="acao" value="adicionar">
            <div class="row g-2">
                <div class="col-md-3"><input type="text" name="nome" placeholder="Nome" class="form-control" required></div>
                <div class="col-md-3"><input type="email" name="email" placeholder="Email" class="form-control" required></div>
                <div class="col-md-3"><input type="text" name="nickname" placeholder="Nickname" class="form-control" required></div>
                <div class="col-md-2"><input type="password" name="senha" placeholder="Senha" class="form-control" required></div>
                <div class="col-md-1"><button type="submit" class="btn btn-secondary w-101">Adicionar</button></div>
            </div>
        </form>
    </div>

    <table class="table table-striped bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Nickname</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($cliente = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $cliente['id_cliente']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $cliente['nickname']; ?></td>
                <td>
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
                        <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" class="form-control form-control-sm mb-1" required>
                        <input type="email" name="email" value="<?php echo $cliente['email']; ?>" class="form-control form-control-sm mb-1" required>
                        <input type="text" name="nickname" value="<?php echo $cliente['nickname']; ?>" class="form-control form-control-sm mb-1" required>
                        <input type="password" name="senha" placeholder="Nova senha (opcional)" class="form-control form-control-sm mb-1">
                        <button type="submit" class="btn btn-primary btn-sm w-100">Editar</button>
                    </form>
                    <a href="?acao=excluir&id_cliente=<?php echo $cliente['id_cliente']; ?>" class="btn btn-danger btn-sm mt-1 w-100">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
<?php mysqli_close($conexao); ?>