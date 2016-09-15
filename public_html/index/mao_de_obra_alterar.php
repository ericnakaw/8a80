<?php

include './conexao/Conexao.php';
include './objeto/MaoDeObra.php';

$arr = $_REQUEST;
$conexao = new Conexao();
$maoDeObra = new MaoDeObra($conexao);
$valor = str_replace(',', '.',$arr["valorMaoDeObra"]);
$maoDeObra->updateMaoDeObra($arr["id"], strtoupper($arr["nomeMaoDeObra"]), $valor);
header("location: mao_de_obra.php");
die();
