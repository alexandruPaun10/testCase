<?php
	session_unset();
	require_once 'controller/customerController.php';
    $controller = new customerController();
    $controller-> mvcHandler();

require_once 'controller/orderController.php';
$controller = new orderController();
$controller-> mvcHandlerOrder();
?>