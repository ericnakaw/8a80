<?php
include './conexao/Conexao.php';
include './objeto/Produto.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$produto = new Produto($conexao);
$produto->deleteProduto($id);
header("location: produto.php");
die();