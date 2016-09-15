<?php

include './conexao/Conexao.php';
include './objeto/Fonte.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nomeFonte"]);
$conexao = new Conexao();
$fonte = new Fonte($conexao);
$fonte->insertFonte($nome);
header("location: fonte.php");
die();
