<?php
session_start();
 
// get the product id
$id = isset($_POST['id']) ? $_POST['id'] : "";
$name = isset($_POST['name']) ? $_POST['name'] : "";
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";
 
/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
if(!isset($_SESSION['cart_items'])){
    $_SESSION['cart_items'] = array();
}
 
// check if the item is in the array, if it is, do not add
if(array_key_exists($id, $_SESSION['cart_items'])){
    // redirect to product list and tell the user it was added to cart
    header('Location: orcamento_produto.php?action=exists&id=' . $id . '&name=' . $name);
} 
 
// else, add the item to the array
else{
    $_SESSION['cart_items'][$id]=$name. ':' .$quantity;
    // redirect to product list and tell the user it was added to cart
    header('Location: orcamento_produto.php?action=added&id=' . $id . '&name=' . $name .'&quantity=' . $quantity);
}
?>