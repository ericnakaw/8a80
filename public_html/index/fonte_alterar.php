<?php

include './conexao/Conexao.php';
include './objeto/Fonte.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nomeFonte"]);
$conexao = new Conexao();
$fonte = new Fonte($conexao);
$fonte->updateFonte($id,$nome);
header("location: fonte.php");
die();

