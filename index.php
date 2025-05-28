<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use src\Elevador;
use src\Descritor;


// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
// ...
$router->get('/', function() { require_once 'templates/public/index.php'; });

$router->get('/teste-simples', function() {
    $elevador = new Elevador(10); // 10 andares

    $descritor = new Descritor($elevador);
    $descritor->renderTest();
});

// Run it!
$router->run();