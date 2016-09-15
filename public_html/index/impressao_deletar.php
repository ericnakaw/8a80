<?php
include './conexao/Conexao.php';
include './objeto/Impressao.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$impressao = new Impressao($conexao);
$impressao->deleteImpressao($id);
header("location: impressao.php");
die();