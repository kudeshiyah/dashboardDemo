<?php
if(!isset($_SESSION))
{
    session_start();
}
// header('Content-Type:multipart/form-data');
require('../conn.class.php');
require('../result.class.php');
require 'Product.class.php';

$db = new DbConnection();
$conn = $db->getDbConn();

$product = new Product($conn);
$product->get_one($_POST = json_decode(file_get_contents('php://input'), true));

?>
