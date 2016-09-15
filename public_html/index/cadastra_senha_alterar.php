<?php

include './conexao/Conexao.php';
include './objeto/Funcionario.php';

$arr = $_REQUEST;
$conexao = new Conexao();
$funcionario = new Funcionario($conexao);
$funcionario->updateSenhaFuncionario($arr["usuario"], $arr["nova_senha"]);
header("location: funcionario.php");
