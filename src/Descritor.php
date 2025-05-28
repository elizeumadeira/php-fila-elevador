<?php

namespace src;

class Descritor
{
    public Elevador $elevador;
    public const serialize = 'elevador.serialized';

    public function __construct(Elevador $elevador)
    {
        $this->elevador = $elevador;
    }
    
    private function escreverProcessoChamada($andar)
    {
        echo "<li>Chamando andar {$andar}</li>";
    }
    
    private function escreverProcessoMovimento($de)
    {
        echo "<li style='color: green;'>Saindo do andar {$de}...: elevador esta agora no andar {$this->elevador->andarAtual}</li>";
    }

    private function tratarExcecaoLista($e)
    {
        echo "<li style='color: red;'>{$e->getMessage()}</li>";
    }

    public function renderTest()
    {
        echo '<ul>';
        
        $acoes = [
            ['chamar', 5],
            ['chamar', 5], // retorna a mensagem "Andar ja foi chamado. Ignorando solicitação."
            ['chamar', 0],
            ['chamar', 5],
            ['mover'],
            ['chamar', 6],
            ['mover'],
            ['mover'],
            ['chamar', 0],
            ['mover'],
            ['chamar', 10],
            ['mover'],
            ['chamar', 5],
            ['mover'],
            ['chamar', 9],
            ['chamar', 8],
            ['chamar', 7],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],

            // uma criança entrou e apertou todos os botões
            ['chamar', 1],
            ['chamar', 2],
            ['chamar', 3],
            ['chamar', 4],
            ['chamar', 5],
            ['chamar', 6],
            ['chamar', 7],
            ['chamar', 8],
            ['chamar', 9],
            ['chamar', 0],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
            ['mover'],
        ];

        foreach($acoes as $acao){
            try{
                $andarAtual = $this->elevador->andarAtual;

                if($acao[0] == 'chamar'){
                    $this->elevador->chamar($acao[1]);
                    $this->escreverProcessoChamada($acao[1]);
                }

                if($acao[0] == 'mover'){
                    $this->elevador->mover();
                    $this->escreverProcessoMovimento($andarAtual);
                    
                }
            }catch(\Exception $e){
                $this->tratarExcecaoLista($e);
            }

            sleep(.2);
        }
        
        echo '</ul>';
    }
}