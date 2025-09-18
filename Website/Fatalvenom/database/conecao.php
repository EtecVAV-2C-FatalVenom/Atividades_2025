<?php

$servername='';
$username='';
$passwd='';
$database='fatalvenom';

$conexao = mysqli_connect($servername, $username, $passwd, $database);

if (!$conexao){
    die("erro de conexão");
} 
echo "Conexão realizado com sucesso!";

mysqli_close($conexao);

?>