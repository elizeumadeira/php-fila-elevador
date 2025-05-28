<?php

namespace src;

use src\interface\DescritorInterface;
use src\Persistencia;
use src\Descritor;
use src\traits\GetObject;

class DescritorScriptController implements DescritorInterface{
    use GetObject;

    function iniciar($capacidade)
    {
        $elevador = new Elevador($capacidade);
        Persistencia::getInstance()->salvar($elevador, Descritor::serialize);

        echo "Nova Fila criado com capacidade: {$capacidade}";
    }

    function visualizar()
    {
        $elevador = $this->getElevadorObj();
        $elevador->filaChamados->setIteratorMode(\SplDoublyLinkedList::IT_MODE_KEEP);

        if($elevador->filaChamados->isEmpty()){
            echo "Fila esta vazia";
            die();
        }

        foreach($elevador->filaChamados as $item){
            echo $item, PHP_EOL;
        }
    }

    function chamar($andar)
    {
        if(!isValidInt($andar) || $andar < 0 ){
            echo 'É necessário adicionar um número inteiro maior que 1';
            die();
        }

        $elevador = $this->getElevadorObj();

        try{
            $elevador->chamar($andar);
        }catch(\Exception $e){
            throw $e;
            die();
        }
        
        Persistencia::getInstance()->salvar($elevador, Descritor::serialize);

        echo 'Item adicionado';

        die();
    }

    function mover()
    {
        $elevador = $this->getElevadorObj();

        try{
            $elevador->mover();
        }catch(\Exception $e){
            throw $e;
            die();
        }

        Persistencia::getInstance()->salvar($elevador, Descritor::serialize);
        echo 'Item movido';

        die();
    }

    function andar()
    {
        $elevador = $this->getElevadorObj();

        echo $elevador->andarAtual;

        die();
    }

    
}