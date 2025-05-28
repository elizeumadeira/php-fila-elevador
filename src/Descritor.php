<?php

namespace src;

class Descritor
{
    public Elevador $elevador;
    private const serialize = 'elevador.serialized';

    public function __construct(Elevador $elevador)
    {
        $this->elevador = $elevador;
    }
    
    private function escreverProcessoChamada($de)
    {
        echo "<li>Elevador foi do andar {$de} para o andar {$this->elevador->andarAtual}</li>";
    }
    
    private function escreverProcessoMovimento($de)
    {
        if($de == $this->elevador->andarAtual){
            echo "<li style='color: green;'>Elevador ja se encontra no andar {$this->elevador->andarAtual}. Nada a fazer.</li>";
        }else{
            echo "<li style='color: green;'>Elevador esta agora no andar {$this->elevador->andarAtual}</li>";
        }
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
            // ['chamar', 5], // retorna a mensagem "Elevador ja se encontra no andar 5. Nada a fazer."
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

                if($acao[0] == 'chamar'){
                    $this->elevador->chamar($acao[1]);
                }

                if($acao[0] == 'mover'){
                    $andarAtual = $this->elevador->andarAtual;
                    $this->elevador->mover();
                    $this->escreverProcessoChamada($andarAtual);
                    $this->escreverProcessoMovimento($andarAtual);
                }
            }catch(\Exception $e){
                $this->tratarExcecaoLista($e);
            }
        }
        
        Persistencia::getInstance()->salvar($this->elevador, self::serialize);
        
        echo '</ul>';
    }
}