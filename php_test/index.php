<?php
	session_unset();
	require_once 'controller/customerController.php';
	require_once 'controller/orderController.php';
	require_once 'controller/graphController.php';
    $controller = new customerController();
    $controller-> mvcHandler();
    $controller = new orderController();
    $controller-> mvcHandlerOrder();
    $controller = new graphController();
    $controller-> mvcHandlerGraph();
?>