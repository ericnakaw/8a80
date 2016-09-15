<?php

include './conexao/Conexao.php';
include './objeto/FitaCategoria.php';

$arr = $_REQUEST;
$conexao = new Conexao();
$fitaCategoria = new FitaCategoria($conexao);
$valor = str_replace(',', '.',$arr["valorCategoriaFita"]);
$fitaCategoria->updateFitaCategoria($arr["id"], strtoupper($arr["nomeCategoriaFita"]), $valor);
header("location: fita_categoria.php");
die();