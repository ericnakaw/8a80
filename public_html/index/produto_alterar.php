<?php

include './conexao/Conexao.php';
include './objeto/Produto.php';

$arr = $_REQUEST;
$id = $arr["id"];
$produtoCategoriaId = $arr["produtoCategoriaId"];
$nome = strtoupper($arr["nomeProduto"]);
$valor = str_replace(",", ".",$arr["valorProduto"]);
$descricao = $arr["descricaoProduto"];
$conexao = new Conexao();
$produto = new Produto($conexao);
$produto->updateProduto($id, $produtoCategoriaId, $nome, $valor, $descricao);
header("location: produto.php");
die();
