<?php
require "db.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit;
}

$inputJSON = file_get_contents("php://input");
$input = json_decode($inputJSON, true);

$email = $_POST["email"] 
         ?? ($input["email"] ?? null);

$senha = $_POST["senha"] 
         ?? ($input["senha"] ?? null);

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
exit;
