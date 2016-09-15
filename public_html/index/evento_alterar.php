<?php

include './conexao/Conexao.php';
include './objeto/Evento.php';

$arr = $_REQUEST;
$id = $arr["id"];
$nome = strtoupper($arr["nomeEvento"]);
$conexao = new Conexao();
$evento = new Evento($conexao);
$evento->updateEvento($id, $nome);
header("location: evento.php");
die();

