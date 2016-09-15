<?php

include './conexao/Conexao.php';
include './objeto/Evento.php';

$arr = $_REQUEST;
$nome = strtoupper($arr["nomeEvento"]);
$conexao = new Conexao();
$evento = new Evento($conexao);
$evento->insertEvento($nome);
header("location: evento.php");
die();
