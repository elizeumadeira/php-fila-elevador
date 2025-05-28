<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use src\Persistencia;
use src\Elevador;
use src\Descritor;
use src\DescritorScriptController;

define('CAPACIDADE_DEFAULT', 10);

function isValidInt($var) {
    return filter_var($var, FILTER_VALIDATE_INT) !== false;
}

function getElevadorObj()
{
    if(!file_exists(Descritor::serialize)){
        return new Elevador(CAPACIDADE_DEFAULT);
    }

    $elevador = Persistencia::getInstance()->recuperar(Descritor::serialize);
    return $elevador;
}

if (!isset($argv[1]) || in_array($argv[1], ['--help', '-help', '-h', '-?'])) {
    echo <<<TEXT
    Iniciar usando php fila.php iniciar <int> (<int> capacidade | default 10)
    Visualizar usando php fila.php visualizar
    Chamar usando php fila.php chamar <int> (<int> andar)
    Mover usando php fila.php mover
    Ver o andar atual usando php fila.php andar
TEXT;
}

$descScrtipt = new DescritorScriptController();

if ($argc >= 2 && $argv[1] == 'iniciar') {
    if(isset($argv[2]) && (!isValidInt($argv[2] || $argv[2] < 1)  )){
        echo "É necessário adicionar um número inteiro maior que 1";
        die();
    }

    $capacidade = CAPACIDADE_DEFAULT;
    if(isset($argv[2])){
        $capacidade = $argv[2];
    }

    $descScrtipt->iniciar($capacidade);
}

if ($argc >= 2 && $argv[1] == 'visualizar') {
    $descScrtipt->visualizar();
}

if ($argc >= 2 && $argv[1] == 'chamar') {
    try{
        $descScrtipt->chamar($argv[2]);
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }

}

if ($argc >= 2 && $argv[1] == 'mover') {
    try{
        $descScrtipt->mover();
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }

    Persistencia::getInstance()->salvar($elevador, Descritor::serialize);
    die();
}

if ($argc >= 2 && $argv[1] == 'andar') {
    $descScrtipt->andar();
}