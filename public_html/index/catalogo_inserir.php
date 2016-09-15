<?php
include './conexao/ConnectionFactory.php';
include './dao/CatalogoDao.php';

$connectionFactory = new ConnectionFactory();
$mysqli = $connectionFactory->get_Mysqli();        
$catalogoDao = new CatalogoDao();
$catalogoDao->insert($_REQUEST['idConvite'], $_REQUEST['pagina'], strtoupper($_REQUEST['item']), $mysqli);
header('location: catalogo.php');
