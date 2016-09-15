<?php
include './conexao/Conexao.php';
include './objeto/Funcionario.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$funcionario = new Funcionario($conexao);
$funcionario->deleteFuncionario($id);
header("location: funcionario.php");
die();