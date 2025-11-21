<?php
require "db.php";

$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

if(!$email || !$senha){
    echo json_encode(["status"=>"erro","mensagem"=>"Informe email e senha"]);
    exit;
}

$sql = $pdo->prepare("SELECT * FROM cliente WHERE email = ?");
$sql->execute([$email]);
$cliente = $sql->fetch(PDO::FETCH_ASSOC);

if(!$cliente){
    echo json_encode(["status"=>"erro","mensagem"=>"Email não encontrado"]);
    exit;
}

if(!password_verify($senha, $cliente["senha"])){
    echo json_encode(["status"=>"erro","mensagem"=>"Senha incorreta"]);
    exit;
}

echo json_encode([
    "status"=>"ok",
    "mensagem"=>"Login efetuado",
    "id_cliente"=>$cliente["id_cliente"],
    "nome"=>$cliente["nome"]
]);
