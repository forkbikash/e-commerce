<?php
if(!defined('dbfunctions')){
    header("HTTP/1.0 404 Not Found");
    exit;
}
//define('DbConn', true);
require './database/DbConn.php';
//define('Product', true);
require './database/Product.php';
//define('Cart', true);
require './database/Cart.php';
//define('User', true);
require './database/User.php';

$db=new DbConn();
$product=new Product($db);
$products=$product->getData();
$cart=new Cart($db);
$user=new User($db);