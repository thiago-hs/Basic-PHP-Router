<?php

include_once 'Request.php';
include_once 'Router.php';

$router = new Router(new Request);

$router->get('/',function(){
	return "rota raiz";
});

$router->get('/perfil', function($request) {
  return <<<HTML
  <h1>SEU PERFIL</h1>
HTML;
});


$router->post('/data', function($request) {
  return json_encode($request->getBody());
});
