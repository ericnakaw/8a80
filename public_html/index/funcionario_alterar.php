<?php
include './conexao/Conexao.php';
include './objeto/Funcionario.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nomeFuncionario"]);
$sobrenome = strtoupper($arr["sobrenomeFuncionario"]);
$cargo = strtoupper($arr["cargoFuncionario"]);
$ativo = $arr["ativoFuncionario"];
$nivel = $arr["nivelFuncionario"];
$usuario = $arr["usuario"];

$conexao = new Conexao();
$funcionario = new Funcionario($conexao);
$funcionario->updateFuncionario($id,$nome,$sobrenome,$cargo, $ativo, $nivel,$usuario);
header("location: funcionario.php");
die();

