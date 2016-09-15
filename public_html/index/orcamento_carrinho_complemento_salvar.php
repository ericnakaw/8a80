<?php

if (!isset($_SESSION)) {
    session_start();
}

//Atribui valor para a variavel que corresponde a data de entrega
foreach ($_SESSION as $keySessao => $valueSessao) {
    if (strstr($keySessao, 'convite-')) {
        foreach ($_REQUEST as $keyRequest => $valueRequest) {
            //Se variavel $keySessao contem ex: convite-1, 
            //atribui-se o valor para a data que veio do REQUEST do respectivo convite 
            if (strstr($keyRequest, $keySessao)) {
                $_SESSION[$keySessao]['data_entrega'] = $valueRequest;
            }
        }
    }
}
$_SESSION['cliente']['local_retirada'] = $_REQUEST["local_retirada"];
$_SESSION['cliente']['tipo_solicitacao'] = $_REQUEST["tipo_solicitacao"];
$_SESSION['local_venda'] = $_REQUEST["local_venda"];

if ($_SESSION['cliente']['tipo_solicitacao'] == "orcamento") {
    header("location: orcamento_convite_salvar.php?acao=salvar_orcamento");
    die();
} else {
    header("location: orcamento_convite_salvar.php?acao=salvar_pedido");
    die();
}
?>