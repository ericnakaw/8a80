<?php

include './conexao/Conexao.php';
include './objeto/ProdutoCategoria.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nome"]);
$conexao = new Conexao();
$categoria = new ProdutoCategoria($conexao);
$categoria->insertProdutoCategoria($nome);
header("location: produto_categoria.php");
die();

