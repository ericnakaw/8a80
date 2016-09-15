<?php
include './conexao/Conexao.php';
include './objeto/Evento.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$evento = new Evento($conexao);
$evento->deleteEvento($id);
header("location: evento.php");
die();