<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

use src\Persistencia;
use src\Elevador;
use src\Descritor;

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
TEXT;
}

if ($argc >= 2 && $argv[1] == 'iniciar') {
    if(isset($argv[2]) && (!isValidInt($argv[2] || $argv[2] < 1)  )){
        echo "É necessário adicionar um número inteiro maior que 1";
        die();
    }

    $capacidade = CAPACIDADE_DEFAULT;
    if(isset($argv[2])){
        $capacidade = $argv[2];
    }

    $elevador = new Elevador($capacidade);
    Persistencia::getInstance()->salvar($elevador, Descritor::serialize);

    echo "Nova Fila criado com capacidade: {$capacidade}";
    die();
}

if ($argc >= 2 && $argv[1] == 'visualizar') {
    $elevador = getElevadorObj();
    $elevador->filaChamados->setIteratorMode(\SplDoublyLinkedList::IT_MODE_KEEP);

    if($elevador->filaChamados->isEmpty()){
        echo "Fila esta vazia";
        die();
    }

    foreach($elevador->filaChamados as $item){
        echo $item, PHP_EOL;
    }

    die();
}

if ($argc >= 2 && $argv[1] == 'chamar') {
        if(!isset($argv[2])){
        echo "É necessário adicionar um número inteiro maior que 1";
        die();
    }

    if(!isValidInt($argv[2]) || $argv[2] < 1 ){
        echo "É necessário adicionar um número inteiro maior que 1";
        die();
    }

    $elevador = getElevadorObj();

    try{
        $elevador->chamar((int) $argv[2]);
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }
    
    Persistencia::getInstance()->salvar($elevador, Descritor::serialize);
}

if ($argc >= 2 && $argv[1] == 'mover') {
    $elevador = getElevadorObj();
    
    try{
        $elevador->mover();
    }catch(\Exception $e){
        echo $e->getMessage();
        die();
    }

    Persistencia::getInstance()->salvar($elevador, Descritor::serialize);
    die();
}