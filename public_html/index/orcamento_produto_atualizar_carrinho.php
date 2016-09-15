<?php

session_start();
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$data = isset($_GET['data']) ? $_GET['data'] : "";
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
//var_dump($_REQUEST);
/*
 * verifica se a sessão ['cart_items'] existe o item
 * se existir, atualiza a quantidade e retorna a mensagem que foi atualizada
 */

if (isset($_SESSION['cart_items'][$id])) {
//    se a quantidade nao for menor que 1, entao:
    if ($quantity > 0) {
        $_SESSION['cart_items'][$id] = $name . ':' . $quantity. ':' . $data;
        // Direciona para a página do carrinho com a mensagem que foi atualizada
        header('Location: orcamento_carrinho.php?action=quantity_updated&id=' . $id . '&name=' . $name . '&quantity=' . $quantity);
    } else {
        // redirect to product list and tell the user it was added to cart
        header('Location: orcamento_carrinho.php?action=update_error&id=' . $id . '&name=' . $name . '&quantity=' . $quantity);
    }
}

/* se o id não existir dentro do array $_SESSION['cart_items'], redireciona para a página do carrinho
 * com a mensagem que não foi possível a atualização
 */
if (!array_key_exists($id, $_SESSION['cart_items'])) {
    // redirect to product list and tell the user it was added to cart
    header('Location: orcamento_carrinho.php?action=update_error&id=' . $id . '&name=' . $name . '&quantity=' . $quantity);
}
?>