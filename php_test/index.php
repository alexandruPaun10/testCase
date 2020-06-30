<?php
	session_unset();
	require_once 'controller/customerController.php';
    $controller = new customerController();
    $controller-> mvcHandler();
?>