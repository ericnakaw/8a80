<?php
include './conexao/ConnectionFactory.php';
include './dao/CatalogoDao.php';

$arr = $_REQUEST;
$id = $arr["id"];
$connectionFactory = new ConnectionFactory();
$mysqli = $connectionFactory->get_Mysqli();
$catalogoDao = new CatalogoDao();
$catalogoDao->delete($id,$mysqli);
header("location: catalogo.php");
die();