<?php

namespace src\interface;

use src\Elevador;

interface DescritorInterface{

    function iniciar($capacidade);

    function visualizar();

    function chamar($andar);

    function mover();

    public function andar();
}