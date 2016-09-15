<?php

include './conexao/Conexao.php';
include './objeto/CorImpressao.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nomeCorImpressao = strtoupper($arr["nomeCorImpressao"]);
$detalheCorImpressao = $arr["detalheCorImpressao"];

$conexao = new Conexao();
$corImpressao = new CorImpressao($conexao);
$corImpressao->updateCorImpressao($id, $nomeCorImpressao, $detalheCorImpressao);
header("location: cor_impressao.php");
die();

