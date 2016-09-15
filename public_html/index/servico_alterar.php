<?php
include './conexao/Conexao.php';
include './objeto/Servico.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nomeServico"]);
$valor = str_replace(",", ".",$arr["valorServico"]);
$conexao = new Conexao();
$servico = new Servico($conexao);
$servico->updateServico($id, $nome, $valor);
header("location: servico.php");
die();
