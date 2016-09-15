<?php
include './conexao/Conexao.php';
include './objeto/CategoriaPapel.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$categoriaPapel = new CategoriaPapel($conexao);
$categoriaPapel->deleteCategoriaPapel($id);
header("location: papel_categoria.php");
die();