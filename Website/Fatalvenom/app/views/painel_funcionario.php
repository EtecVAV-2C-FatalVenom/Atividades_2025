<?php
session_start();

if (!isset($_SESSION['id_funcionario']) || ($_SESSION['cargo'] !== 'Administrador' && $_SESSION['cargo'] !== 'Gerente' && $_SESSION['cargo'] !== 'Funcionario')) {
    header('Location: ../views/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; }
        h1 { color: #333; }
        .actions { margin: 30px 0; display: flex; gap: 20px; flex-wrap: wrap; }
        .action-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 20px;
            flex: 1 1 200px;
            min-width: 200px;
            text-align: center;
            transition: box-shadow 0.2s;
        }
        .action-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        a.button {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 18px;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
        }
        a.button:hover { background: #0056b3; }
        .logout { float: right; }
    </style>
</head>
<body>
    <div class="container">
        <a href="../controllers/logout.php" class="button logout">Sair</a>
        <h1>Painel do Funcionário</h1>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p>
        <div class="actions">
            <?php if ($_SESSION['cargo'] === 'Administrador' || $_SESSION['cargo'] === 'Gerente'): ?>
            <div class="action-card">
                <div class="dropdown">
                    <h2>Gerenciar Usuários</h2>
                    <p>Gerencie os usuários do sistema.</p>
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if ($_SESSION['cargo'] === 'Administrador' || $_SESSION['cargo'] === 'Gerente'): ?>
                            Acessar
                        <?php endif; ?>
                        <?php if ($_SESSION['cargo'] !== 'Administrador' || $_SESSION['cargo'] !== 'Gerente'): ?>
                            Acesso Negado
                        <?php endif; ?>
                    </a>       
                    <ul class="dropdown-menu">
                        <?php if ($_SESSION['cargo'] === 'Administrador' || $_SESSION['cargo'] === 'Gerente'): ?>
                        <li><a class="dropdown-item" href="gerenciar_funcionarios.php">Gerenciar Funcionários</a></li>
                        <li><a class="dropdown-item" href="gerenciar_clientes.php">Gerenciar Clientes</a></li>
                        <?php endif; ?>
                        
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="action-card">
                <h2>Gerenciar Produtos</h2>
                <p>Adicione, edite ou remova produtos do sistema.</p>
                <a href="../views/gerenciar_produtos.php" class="button">Acessar</a>
            </div>
            
            <div class="action-card">
                <h2>Configurações</h2>
                <p>Altere configurações do seu usuário.</p>
                <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Configurações</a>        
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="altera_nickname.php">Alterar Nome</a></li>
                        <li><a class="dropdown-item" href="altera_senha.php">Alterar Senha</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>