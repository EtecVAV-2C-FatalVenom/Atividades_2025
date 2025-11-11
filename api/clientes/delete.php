<?php

if($acao == "" && $param == '') { echo json_encode(['ERRO' => 'Caminho não encontrado!']); exit;}
if($acao == 'delete' && $param == '') { echo json_encode(['ERRO' => 'É necessário informar um cliente!']);}

if($acao == 'delete' && $param != ''){

    "DELETE FROM clientes WHERE id={$param}";
}

$db = DB::connect();
    $rs = $db->prepare("DELETE FROM clientes WHERE  id={$param}");
    $exec = $rs->execute();

    if($exec) {
        echo json_encode(["dados" => 'Os dados foram apagados!']);
    } else{
        echo json_encode(["dados" => 'Houve algum problema ao excluir os dados!']);
    }

?>