<?php
session_start();

if (!isset($_SESSION['nome']) || $_SESSION['cargo'] !== 'Administrador' && $_SESSION['cargo'] !== 'Gerente') {
    header('Location: /login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Painel do Funcionário</title>
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
            <div class="action-card">
                <h2>Gerenciar Usuários</h2>
                <p>Adicionar, editar ou remover usuários do sistema.</p>
                <a href="/app/views/usuarios.php" class="button">Acessar</a>
            </div>
            <div class="action-card">
                <h2>Visualizar Relatórios</h2>
                <p>Acesse relatórios de atividades e desempenho.</p>
                <a href="/app/views/relatorios.php" class="button">Acessar</a>
            </div>
            <div class="action-card">
                <h2>Configurações</h2>
                <p>Altere configurações do sistema.</p>
                <a href="/app/views/configuracoes.php" class="button">Acessar</a>
            </div>
        </div>
    </div>
</body>
</html></div>