<?php
include './conexao/Conexao.php';
include './objeto/Fita.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$fita = new Fita($conexao);
$fita->deleteFita($id);
header("location: fita.php");
die();