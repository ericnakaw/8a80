<?php
include './conexao/Conexao.php';
include './objeto/Papel.php';

$arr = $_REQUEST;
$nomePapel = strtoupper($arr["nomePapel"]);
$categoriaPapelId = $arr["categoriaPapelId"];
$gramaturaPapel = $arr["gramaturaPapel"];
$conexao = new Conexao();
$papel = new Papel($conexao);
$papel->insertPapel($nomePapel,$categoriaPapelId,$gramaturaPapel);
header("location: papel.php");
die();
