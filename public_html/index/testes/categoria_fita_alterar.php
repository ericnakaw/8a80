<?php

include './conexao/Conexao.php';
include './objeto/CategoriaFita.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = $arr["nomeCategoria"];
$valor = $arr["valorCategoria"];

//teste
//$id = 2;
//$nome = "Gorgurão";
//$valor = 45;

$conexao = new Conexao();
$categoriaFita = new CategoriaFita($conexao);
$categoriaFita->setIdCategoria($id);
$categoriaFita->setNomeCategoria($nome);
$categoriaFita->setValorCategoria($valor);

$return = $categoriaFita->updateCategoriaFita();

?>