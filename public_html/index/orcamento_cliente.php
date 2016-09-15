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
include './header2.php';
$evento = $_SESSION['cliente']["evento"];
$data_evento = $_SESSION['cliente']["data_evento"];
$nome = $_SESSION['cliente']["nome"];
$sobrenome = $_SESSION['cliente']["sobrenome"];
$email = $_SESSION['cliente']["email"];
$celular = $_SESSION['cliente']["celular"];
$telefone = $_SESSION['cliente']["telefone"];
$rg = $_SESSION['cliente']["rg"];
$cpf = $_SESSION['cliente']["cpf"];
$nome2 = $_SESSION['cliente']["nome2"];
$sobrenome2 = $_SESSION['cliente']["sobrenome2"];
$email2 = $_SESSION['cliente']["email2"];
$celular2 = $_SESSION['cliente']["celular2"];
$telefone2 = $_SESSION['cliente']["telefone2"];
$rg2 = $_SESSION['cliente']["rg2"];
$cpf2 = $_SESSION['cliente']["cpf2"];
$rua = $_SESSION['cliente']["rua"];
$numero = $_SESSION['cliente']["numero"];
$complemento = $_SESSION['cliente']["complemento"];
$bairro = $_SESSION['cliente']["bairro"];
$cep = $_SESSION['cliente']["cep"];
$cidade = $_SESSION['cliente']["cidade"];
$estado = $_SESSION['cliente']["estado"];
$observacao = $_SESSION['cliente']["observacao"];
?>
<body>
<?php include './cliente_form.php';?>
</body>