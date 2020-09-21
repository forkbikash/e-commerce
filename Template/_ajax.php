<?php
require '../database/DbConn.php';
require '../database/Product.php';
$db = new DbConn();

$product=new Product($db);

if($string=file_get_contents('php://input')){
    $associative_array=json_decode($string, true);
    $product_rows = $product->getProduct($associative_array['item_id']);
    echo json_encode($product_rows);
}

/*$product_rows=$product->getProduct($_POST['item_id']);
if (isset($_POST['item_id'])){
    $product_rows = $product->getProduct($_POST['item_id']);
    echo json_encode($product_rows);
}*/