<?php
session_start();
 
$page_title="Products";
include 'layout_head.php';
 
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "1";
$name = isset($_GET['name']) ? $_GET['name'] : "";
 
if($action=='added'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> was added to your cart!";
    echo "</div>";
}
 
if($action=='exists'){
    echo "<div class='alert alert-info'>";
        echo "<strong>{$name}</strong> already exists in your cart!";
    echo "</div>";
}
 
$query = "SELECT id, name, price FROM products ORDER BY name";
$stmt = $con->prepare( $query );
$stmt->execute();
 
$num = $stmt->rowCount();
 
if($num>0){
 
    //start table
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
        // our table heading
        echo "<tr>";
            echo "<th class='textAlignLeft'>Product Name</th>";
            echo "<th>Price (USD)</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
 
            //creating new table row per record
            echo "<tr>";
                echo "<td>";
                    echo "<div class='product-id' style='display:none;'>{$id}</div>";
                    echo "<div class='product-name'>{$name}</div>";
                echo "</td>";
                echo "<td>&#36;{$price}</td>";
                echo "<td>";
                    echo "<a href='add_to_cart.php?id={$id}&name={$name}' class='btn btn-primary'>";
                        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                    echo "</a>";
                echo "</td>";
            echo "</tr>";
        }
 
    echo "</table>";
}
 
// tell the user if there's no products in the database
else{
    echo "No products found.";
}
 
include 'layout_foot.php';
?>