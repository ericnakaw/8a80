<?php

include './conexao/Conexao.php';
include './objeto/CategoriaPapel.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nomeCategoriaPapel"]);
$valor = str_replace(",", ".",$arr["valorCategoriaPapel"]);
$conexao = new Conexao();
$categoriaPapel = new CategoriaPapel($conexao);
$categoriaPapel->updateCategoriaPapel($id, $nome, $valor);
header("location: papel_categoria.php");
die();

