<?php
include './conexao/Conexao.php';
include './objeto/Servico.php';

$arr = $_REQUEST;
$id = $arr["id"];
$name = $arr["name"];
$conexao = new Conexao();
$servico = new Servico($conexao);
$servico->deleteServico($id);
header('Location: servico.php?action=removed&id=' . $id . '&name=' . $name);
die();