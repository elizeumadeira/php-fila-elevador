<?php

// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use src\Elevador;
use src\Descritor;

define('CAPACIDADE_DEFAULT', 10);

function isValidInt($var) {
    return filter_var($var, FILTER_VALIDATE_INT) !== false;
}

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
// ...
$router->get('/', function() { require_once '../templates/public/index.php'; });

$router->get('/iniciar/(\d+)', '\src\DescritorJsonController@iniciar');
$router->get('/chamar/(\d+)', '\src\DescritorJsonController@chamar');
$router->get('/mover', '\src\DescritorJsonController@mover');
$router->get('/visualizar', '\src\DescritorJsonController@visualizar');
$router->get('/andar', '\src\DescritorJsonController@andar');

$router->get('/teste-simples', function() {
    $elevador = new Elevador(10); // 10 andares

    $descritor = new Descritor($elevador);
    $descritor->renderTest();
});

// Run it!
$router->run();