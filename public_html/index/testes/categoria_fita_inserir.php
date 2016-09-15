<?php

include './conexao/Conexao.php';
include './objeto/CategoriaFita.php';
$arr = $_REQUEST;
$acao = $arr["acao"];
$nome = $arr["nomeCategoria"];
$valor = $arr["valorCategoria"];
switch ($acao) {
    case "editar":
        if (!empty($arr["nomeCategoria"]) && !empty($arr["valorCategoria"])) {
            $conexao = new Conexao();
            $categoriaFita = new CategoriaFita($conexao);
            $categoriaFita->setNomeCategoria($nome);
            $categoriaFita->setValorCategoria($valor);
            $return = $categoriaFita->insertCategoriaFita();
            return $return;
        } else {
            return false;
        }
        break;
     default:
        break;
}
?>