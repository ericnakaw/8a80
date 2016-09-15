<?php
include './conexao/Conexao.php';
include './objeto/ConviteModelo.php';

$arr = $_REQUEST;
$id = $arr["id"];
$conexao = new Conexao();
$conviteModelo = new ConviteModelo($conexao);
$conviteModelo->deleteConviteModelo($id);
header("location: convite_modelo.php");