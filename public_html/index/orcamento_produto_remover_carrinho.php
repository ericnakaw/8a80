<?php

session_start();

// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";

// remove o produto do carrinho
if (isset($_GET['id'])) {
    unset($_SESSION['cart_items'][$id]);
    // Redireciona para a página informando o usuário que o produto foi removido
    header('Location: orcamento_carrinho.php?action=removed&id=' . $id . '&name=' . $name);
    die();
}
if ($_GET['acao'] === "limpar_todos") {
    unset($_SESSION['cart_items']);
    header('Location: orcamento_carrinho.php?action=all_removed_sucess');
    die();
}
header('Location: orcamento_carrinho.php');
die()
?>