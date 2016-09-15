<?php
include './conexao/Conexao.php';
include './objeto/CorImpressao.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$corImpressao = new CorImpressao($conexao);
$corImpressao->deleteCorImpressao($id);
header("location: cor_impressao.php");
die();