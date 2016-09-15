<?php
include './conexao/Conexao.php';
include './objeto/Acabamento.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$acabamento = new Acabamento($conexao);
$acabamento->deleteAcabamento($id);
header("location: acabamento.php");