<?php

include './conexao/Conexao.php';
include './objeto/CategoriaPapel.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nomeCategoriaPapel"]);
$valor = str_replace(",", ".",$arr["valorCategoriaPapel"]);
$conexao = new Conexao();
$categoriaPapel = new CategoriaPapel($conexao);
$categoriaPapel->insertCategoriaPapel($nome, $valor);
header("location: papel_categoria.php");
die();
