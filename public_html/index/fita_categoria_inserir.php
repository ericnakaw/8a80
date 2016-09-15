<?php

include './conexao/Conexao.php';
include './objeto/FitaCategoria.php';

$arr = $_REQUEST;
$valor = str_replace(',', '.',$arr["valorCategoriaFita"]);
$conexao = new Conexao();
$fitaCategoria = new FitaCategoria($conexao);
$fitaCategoria->insertFitaCategoria(strtoupper($arr["nomeCategoriaFita"]),$valor);
header("location: fita_categoria.php");
die();

