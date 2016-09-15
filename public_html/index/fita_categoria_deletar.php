<?php
include './conexao/Conexao.php';
include './objeto/FitaCategoria.php';

$arr = $_REQUEST;
var_dump($arr);
$conexao = new Conexao();
$fitaCategoria = new FitaCategoria($conexao);
$fitaCategoria->deleteFitaCategoria($arr["id"]);
header("location: fita_categoria.php");
die();