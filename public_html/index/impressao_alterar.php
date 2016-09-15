<?php

include './conexao/Conexao.php';
include './objeto/Impressao.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nomeImpressao"]);
$valor = str_replace(",", ".",$arr["valorImpressao"]);
$conexao = new Conexao();
$impressao = new Impressao($conexao);
$impressao->updateImpressao($id, $nome, $valor);
header("location: impressao.php");
die();

