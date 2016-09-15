<?php

include './conexao/Conexao.php';
include './objeto/Funcionario.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nomeFuncionario"]);
$sobrenome = strtoupper($arr["sobrenomeFuncionario"]);
$cargo = strtoupper($arr["cargoFuncionario"]);
$nivel = $arr["nivelFuncionario"];
$ativo = $arr["ativoFuncionario"];
$usuario = $arr["usuario"];
$conexao = new Conexao();
$funcionario = new Funcionario($conexao);
$funcionario->insertFuncionario($nome,$sobrenome,$cargo,$nivel,$ativo,$usuario);
header("location: funcionario.php");
die();
