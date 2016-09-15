<?php

include './conexao/Conexao.php';
include './objeto/CategoriaFita.php';

$arr = $_REQUEST;
//$id = $arr["id"];

//teste
$id = 77;

$conexao = new Conexao();
$categoriaFita = new CategoriaFita($conexao);
$categoriaFita->setIdCategoria($id);

$return = $categoriaFita->deleteCategoriaFita();

?>