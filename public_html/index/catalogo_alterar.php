<?php

include './conexao/ConnectionFactory.php';
include './dao/CatalogoDao.php';
include './objeto/Catalogo.php';

$connectionFactory = new ConnectionFactory();
$mysqli = $connectionFactory->get_Mysqli();
$catalogo = new Catalogo($_REQUEST["id"], $_REQUEST["idConvite"], $_REQUEST["pagina"], strtoupper($_REQUEST["item"]));
$catalogoDao = new CatalogoDao();
$catalogoDao->update($catalogo->getId_catalogo(),$catalogo->getId_convite(),$catalogo->getPagina(),$catalogo->getItem(),$mysqli);
header("location: catalogo.php");
die();
