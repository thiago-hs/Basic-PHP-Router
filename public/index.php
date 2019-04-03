<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'Request.php';
include_once 'Router.php'

$router = new Router(new Request);

$router->get('/',function(){
	return "rota raiz";
});

