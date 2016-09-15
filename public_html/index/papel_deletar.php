<?php
include './conexao/Conexao.php';
include './objeto/Papel.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$papel = new Papel($conexao);
$papel->deletePapel($id);
header("location: papel.php");
die();