<?php
if(!isset($_SESSION))
{
    session_start();
}
require('../conn.class.php');
require('../result.class.php');
require 'Product.class.php';

$conn = new DbConnection();
$conn = $conn->getDbConn();

$product = new Product($conn);
$product->create(json_decode(file_get_contents('php://input'), true));
?>
