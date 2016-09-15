<!DOCTYPE html>
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if (!isset($_SESSION)) {
    session_start();
}
$permissao = Array("gerente", "tecnico", "vendas");
if (!in_array($_SESSION["UsuarioNivel"], $permissao)) {
    header("location: login.php?msg=Sem_permisao");
    die();
}

include './header.php';

$id_cliente = $_GET["id_cliente"];
$evento = $_GET["evento_tipo"];
$data_evento = date_format(date_create($_GET["data_evento"]), "Y-m-d");
$nome = $_GET["nome"];
$sobrenome = $_GET["sobrenome"];
$email = $_GET["email"];
$celular = $_GET["celular"];
$telefone = $_GET["telefone"];
$rg = $_GET["rg"];
$cpf = $_GET["cpf"];
$nome2 = $_GET["nome2"];
$sobrenome2 = $_GET["sobrenome2"];
$email2 = $_GET["email2"];
$celular2 = $_GET["celular2"];
$telefone2 = $_GET["telefone2"];
$rg2 = $_GET["rg2"];
$cpf2 = $_GET["cpf2"];
$rua = $_GET["rua"];
$numero = $_GET["numero"];
$complemento = $_GET["complemento"];
$bairro = $_GET["bairro"];
$cep = $_GET["cep"];
$cidade = $_GET["cidade"];
$estado = $_GET["estado"];
$observacao = $_GET["observacao"];
?>
<body>
    <?php include './cliente_form.php'; ?>
</body>