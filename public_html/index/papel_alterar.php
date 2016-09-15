<?php
include './conexao/Conexao.php';
include './objeto/Papel.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nomePapel = strtoupper($arr["nomePapel"]);
$categoriaPapelId = $arr["categoriaPapelId"];
$gramaturaPapel = $arr["gramaturaPapel"];

$conexao = new Conexao();
$papel = new Papel($conexao);
$papel->updatePapel($id,$nomePapel,$categoriaPapelId,$gramaturaPapel);
header("location: papel.php");
die();

