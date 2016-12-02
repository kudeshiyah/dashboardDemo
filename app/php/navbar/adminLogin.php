<?php
if(!isset($_SESSION))
{
    session_start();
}
require('../conn.class.php');
require('../user.class.php');


$conn = new DbConnection();
$conn = $conn->getDbConn();

$_POST = json_decode(file_get_contents('php://input'), true);

$user = new User("");
$user->adminLogin($_POST);
?>
