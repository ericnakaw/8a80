<?php

include './conexao/Conexao.php';
include './objeto/MaoDeObra.php';

$arr = $_REQUEST;
$valor = str_replace(',', '.',$arr["valorMaoDeObra"]);
$conexao = new Conexao();
$maoDeObra = new MaoDeObra($conexao);
$maoDeObra->insertMaoDeObra(strtoupper($arr["nomeMaoDeObra"]),$valor);
header("location: mao_de_obra.php");
die();
