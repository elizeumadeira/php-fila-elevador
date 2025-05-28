<?php

namespace src;

use SplQueue;

class Elevador
{
    public $filaChamados;
    public $andarAtual;
    public $capacidade;

    public function __construct(int $capacidade = 10)
    {
        $this->filaChamados = new SplQueue();
        $this->andarAtual = 0; // térreo
        $this->capacidade = $capacidade;
    }

    public function chamar(int $andar): bool
    {
        if($andar < 0 && $andar > $this->capacidade){
            throw new \Exception("Número de andar inexistente");
        }

        if(!$this->filaChamados->isEmpty() && $this->filaChamados->top() == $andar){
            throw new \Exception("Andar {$andar} ja foi chamado. Ignorando solicitação.");
        }

        $this->filaChamados->enqueue($andar);

        return true;
    } 

    public function mover(): bool
    {
        if($this->filaChamados->isEmpty()){
            throw new \Exception("Fila esta vazia");
        }

        $andar = $this->filaChamados->dequeue();
        $this->andarAtual = $andar;

        return true;
    }

    public function getAndarAtual(): int 
    {
        return $this->andarAtual;
    } 

    public function getChamadosPendentes(): SplQueue
    {
        $filaClone = clone $this->filaChamados;
        return  $filaClone;
    }


}
