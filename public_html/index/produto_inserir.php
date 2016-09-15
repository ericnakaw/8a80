<?php

include './conexao/Conexao.php';
include './objeto/Produto.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nomeProduto"]);
$produtoCategoriaId = $arr["produtoCategoriaId"];
$valor = str_replace(",", ".",$arr["valorProduto"]);
$descricao = $arr["descricaoProduto"];
$conexao = new Conexao();
$produto = new Produto($conexao);
$produto->insertProduto($nome, $produtoCategoriaId, $valor, $descricao);
header("location: produto.php");
die();
