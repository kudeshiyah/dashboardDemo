<?php
if(!isset($_SESSION))
{
    session_start();
}
require('conn.class.php');

$_POST = json_decode(file_get_contents('php://input'), true);


DbConnection::set_city($_POST['city']);

?>
