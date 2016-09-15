<?php
include './conexao/Conexao.php';
include './objeto/ProdutoCategoria.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nome"]);
$conexao = new Conexao();
$categoria = new ProdutoCategoria($conexao);
$categoria->updateProdutoCategoria($id, $nome);
header("location: produto_categoria.php");
die();
