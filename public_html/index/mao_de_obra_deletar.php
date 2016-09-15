<?php
include './conexao/Conexao.php';
include './objeto/MaoDeObra.php';

$arr = $_REQUEST;
$conexao = new Conexao();
$maoDeObra = new MaoDeObra($conexao);
$maoDeObra->deleteMaoDeObra($arr["id"]);
header("location: mao_de_obra.php");
die();