<?php
include './conexao/Conexao.php';
include './objeto/ProdutoCategoria.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$categoria = new ProdutoCategoria($conexao);
$categoria->deleteProdutoCategoria($id);
header("location: produto_categoria.php");
die();