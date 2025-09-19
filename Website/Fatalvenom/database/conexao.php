<?php

$servername='127.0.0.1';
$username='root';
$passwd='';
$database='fatalvenom';

$conexao = mysqli_connect($servername, $username, $passwd, $database);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>