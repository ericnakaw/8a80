<?php

include './conexao/Conexao.php';
include './objeto/Servico.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nomeServico"]);
$valor = str_replace(",", ".",$arr["valorServico"]);
$conexao = new Conexao();
$servico = new Servico($conexao);
$servico->insertServico($nome, $valor);
header('Location: servico.php?action=added&id=' . $id . '&name=' . $nome);
die();

