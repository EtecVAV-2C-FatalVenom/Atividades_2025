<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$name = isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'Nome do Usuário';
$mail = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Email do Usuário';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="perfil-container">
        <img src="https://i.pravatar.cc/100" alt="Avatar" class="perfil-avatar">
        <div>Nome: <?php echo $name ?></div>
        <div>Email: <?php echo $mail ?> </div>
        <a href="../app/controllers/logout.php" class="btn btn-danger">Sair</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>