<?php
session_start();
include_once("../../database/conexao.php");


if (isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $imagem = $_POST['imagem']; 

    $sql = "INSERT INTO produto (nome, preco, categoria, imagem) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sdss", $nome, $preco, $categoria, $imagem);
    mysqli_stmt_execute($stmt);
}

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM produto WHERE id = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
}


if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $imagem = $_POST['imagem'];

    $sql = "UPDATE produto SET nome=?, preco=?, categoria=?, imagem=? WHERE id=?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "sdssi", $nome, $preco, $categoria, $imagem, $id);
    mysqli_stmt_execute($stmt);
}


$sql = "SELECT * FROM produto ORDER BY id DESC";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="mb-4">Gerenciar Produtos</h1>

  
    <div class="card mb-4 p-3">
        <h5>Adicionar Produto</h5>
        <form method="POST">
            <input type="hidden" name="acao" value="adicionar">
            <div class="row g-2">
                <div class="col-md-3"><input type="text" name="nome" placeholder="Nome" class="form-control" required></div>
                <div class="col-md-2"><input type="text" name="preco" placeholder="Preço" class="form-control" required></div>
                <div class="col-md-3"><input type="text" name="categoria" placeholder="Categoria" class="form-control" required></div>
                <div class="col-md-3"><input type="text" name="imagem" placeholder="URL Imagem" class="form-control" required></div>
                <div class="col-md-1"><button type="submit" class="btn btn-success w-100">Adicionar</button></div>
            </div>
        </form>
    </div>

  
    <table class="table table-striped bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($produto = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $produto['id']; ?></td>
                <td><?php echo $produto['nome']; ?></td>
                <td><?php echo $produto['preco']; ?></td>
                <td><?php echo $produto['categoria']; ?></td>
                <td><img src="<?php echo $produto['imagem']; ?>" width="50" alt=""></td>
                <td>
                 
                    <form method="POST" class="d-inline">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                        <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" class="form-control form-control-sm mb-1" required>
                        <input type="text" name="preco" value="<?php echo $produto['preco']; ?>" class="form-control form-control-sm mb-1" required>
                        <input type="text" name="categoria" value="<?php echo $produto['categoria']; ?>" class="form-control form-control-sm mb-1" required>
                        <input type="text" name="imagem" value="<?php echo $produto['imagem']; ?>" class="form-control form-control-sm mb-1" required>
                        <button type="submit" class="btn btn-primary btn-sm w-100">Editar</button>
                    </form>
                    <a href="?acao=excluir&id=<?php echo $produto['id']; ?>" class="btn btn-danger btn-sm mt-1 w-100">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
<?php mysqli_close($conexao); ?>
