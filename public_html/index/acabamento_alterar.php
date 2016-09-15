<?php

include './conexao/Conexao.php';
include './objeto/Acabamento.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nomeAcabamento"]);
$valor = str_replace(",", ".", $arr["valorAcabamento"]);

$conexao = new Conexao();
$acabamento = new Acabamento($conexao);
$acabamento->updateAcabamento($id, $nome, $valor);
header("location: acabamento.php");

