<?php

error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
if (!isset($_SESSION)) {
    session_start();
}

isset($_SESSION['cliente']) ? $_SESSION['cliente'] : $_SESSION['cliente'] = array();
//Data do Evento
$_SESSION['cliente']["evento"] = $_POST['evento'];
if ($_POST["data_evento"]) {
    $_SESSION['cliente']["data_evento"] = date_format(date_create($_POST["data_evento"]), "Y-m-d");
}
//Endereço
$_SESSION['cliente']["rua"] = $_POST["rua"];
$_SESSION['cliente']["numero"] = $_POST["numero"];
$_SESSION['cliente']["bairro"] = $_POST["bairro"];
$_SESSION['cliente']["complemento"] = $_POST["complemento"];
$_SESSION['cliente']["cep"] = $_POST["cep"];
$_SESSION['cliente']["cidade"] = $_POST["cidade"];
$_SESSION['cliente']["estado"] = $_POST["estado"];
$_SESSION['cliente']["observacao"] = $_POST["observacao"];
//Pessoa 1
$_SESSION['cliente']["nome"] = $_POST["nome"];
$_SESSION['cliente']["sobrenome"] = $_POST["sobrenome"];
$_SESSION['cliente']["email"] = $_POST["email"];
$_SESSION['cliente']["telefone"] = $_POST["telefone"];
$_SESSION['cliente']["celular"] = $_POST["celular"];
$_SESSION['cliente']["rg"] = $_POST["rg"];
$_SESSION['cliente']["cpf"] = $_POST["cpf"];
//Pessoa 2
$_SESSION['cliente']["nome2"] = $_POST["nome2"];
$_SESSION['cliente']["sobrenome2"] = $_POST["sobrenome2"];
$_SESSION['cliente']["email2"] = $_POST["email2"];
$_SESSION['cliente']["telefone2"] = $_POST["telefone2"];
$_SESSION['cliente']["celular2"] = $_POST["celular2"];
$_SESSION['cliente']["rg2"] = $_POST["rg2"];
$_SESSION['cliente']["cpf2"] = $_POST["cpf2"];

if ($_REQUEST["tipo_solicitacao"]) {
    $_SESSION['cliente']['tipo_solicitacao'] = $_REQUEST["tipo_solicitacao"];
}
if ($_REQUEST["localVenda"]) {
    $_SESSION['local_venda'] = $_REQUEST["localVenda"];
}


if ($_GET['acao'] == 'limpar') {
    unset($_SESSION['cliente']);
    header('location: orcamento_cliente.php');
    die();
}
if ($_GET['acao'] == 'limpar_pre_atendimento') {
    unset($_SESSION['cliente']);
    header('location: orcamento_novo.php');
    die();
}
header('location: orcamento_convite.php');
?>