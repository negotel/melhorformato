<?php
ob_start();

/**
 *  @author Edson Costa
 *  @package Index 
*/

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(url(), "@");
$route->namespace("Source\Application\Web");

$route->group(null);
$route->get('/', "Login@index");
$route->get('/entrar', "Login@index");
$route->get('/cadastrar', "Login@register");
$route->get('/esqueci-minha-senha', "Login@forgot_password");

$route->get('/mapa', "Mapa@index");
$route->get('/mapa-novo', "Mapa@mapaNovo");
$route->get('/setting', "Setting@index");
$route->post('/importacao', "Mapa@importacao");

$route->dispatch();
if($route->error()) {
  echo $route->error();
}

ob_end_flush();