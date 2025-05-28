<?php

namespace src\traits;

use src\Elevador;
use src\Persistencia;
use src\Descritor;

trait GetObject {

    public function getElevadorObj(): Elevador
    {
        if(!file_exists(Descritor::serialize)){
            return new Elevador(CAPACIDADE_DEFAULT);
        }

        $elevador = Persistencia::getInstance()->recuperar(Descritor::serialize);
        return $elevador;
    }
}