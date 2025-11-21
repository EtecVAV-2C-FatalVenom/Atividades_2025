// By FatalVenom - ETECVAV - 2025

<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json'); 
date_default_timezone_set("America/Sao_Paulo"); 

$uri = $_SERVER['REQUEST_URI'];
$base_path = '/api/';
if (substr($uri, 0, strlen($base_path)) == $base_path) {
    $uri = substr($uri, strlen($base_path));
}
$path = explode('/', trim($uri, '/'));

if (empty($path[0])) {
    echo "Caminho não existe";
    exit;
}

if (isset($path[0])) { 
    $api = $path[0]; 
} else { 
    echo "Caminho não existe"; 
    exit; 
} 
if (isset($path[1])) { 
    $acao = $path[1];
} else { 
    $acao = "";
}
if (isset($path[2])) { 
    $param = $path[2];
} else { 
    $param = "";
}

$method = $_SERVER['REQUEST_METHOD'];


$GLOBALS['secretJWT'] = '123456';

include_once "classes/db.class.php";
include_once "classes/jwt.class.php";
include_once "classes/usuarios.class.php";

include_once "api/usuarios/usuarios.php";
include_once "api/clientes/clientes.php";
?>