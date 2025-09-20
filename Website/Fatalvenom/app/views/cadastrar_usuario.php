<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">Cadastre-se</h5>
            
            <?php 

            if (!empty($mensagem)): 
            ?>
                <div class="alert <?php echo ($mensagem === 'Cadastro realizado com sucesso!') ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                    <?php echo $mensagem; ?>
                </div>
            <?php endif; ?>
            
            <form action="../controllers/cadastro_processa.php" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="nickname" class="form-label">Nickname</label>
                    <input type="text" class="form-control" id="nickname" name="nickname" required>
                </div>              
                <div class="mb-3">
                    <label for="email" class="form-label">Endereço de E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>              
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="mb-3">
                    <label for="confirma_senha" class="form-label">Confirme a Senha</label>
                    <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
            <p class="mt-3 text-center">Já tem uma conta? <a href="../views/login.php">Faça login aqui</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>