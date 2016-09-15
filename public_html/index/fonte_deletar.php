<?php
include './conexao/Conexao.php';
include './objeto/Fonte.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$fonte = new Fonte($conexao);
$fonte->deleteFonte($id);
header("location: fonte.php");
die();