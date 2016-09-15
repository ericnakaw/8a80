<?php

include './conexao/Conexao.php';
include './objeto/Acabamento.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nomeAcabamento"]);
$valor = str_replace(",", ".", $arr["valorAcabamento"]);
$conexao = new Conexao();
$acabamento = new Acabamento($conexao);
$acabamento->insertAcabamento($nome, $valor);
header("location: acabamento.php");
