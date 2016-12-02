<?php
if(!isset($_SESSION))
{
    session_start();
}
require('../conn.class.php');
require('../result.class.php');
require 'Product.class.php';

$db = new DbConnection();
$conn = $db->getDbConn();

$product = new Product($conn);
$product->get_all($_POST);

?>
