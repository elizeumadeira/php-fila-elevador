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

    private function visualizar()
    {
        $chamados = $this->elevador->getChamadosPendentes();
        // $chamados = $this->elevador->filaChamados;

        $chamados->setIteratorMode(\SplDoublyLinkedList::IT_MODE_KEEP);

        if ($chamados->isEmpty()) {
            return '--';
        }

        $items = '<ul>';
        foreach ($chamados as $item) {
            $items .= '<li>' . $item . '</li>';
        }
        $items .= '</ul>';

        return $items;
    }

    private function escreverProcessoChamada($andar)
    {
        return "<details>
    <summary>Chamando andar {$andar}</summary>
    <p>" . $this->visualizar() . "</p>
</details>";
    }

    private function escreverProcessoMovimento($de)
    {
        return "<details>
    <summary>Saindo do andar {$de}...: elevador esta agora no andar {$this->elevador->andarAtual}</summary>
    <p>" . $this->visualizar() . "</p>
</details>";
    }

    private function tratarExcecaoLista($e)
    {
        return "<details>
                <summary>{$e->getMessage()}</summary>
                <p>" . $this->visualizar() . "</p>
            </details>";
    }

    public function renderTest()
    {

        $html = '';

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

        foreach ($acoes as $acao) {
            try {
                $andarAtual = $this->elevador->andarAtual;

                if ($acao[0] == 'chamar') {
                    $this->elevador->chamar($acao[1]);
                    $html .= $this->escreverProcessoChamada($acao[1]);
                }

                if ($acao[0] == 'mover') {
                    $this->elevador->mover();
                    $html .= $this->escreverProcessoMovimento($andarAtual);

                }
            } catch (\Exception $e) {
                $html .= $this->tratarExcecaoLista($e);
            }

        }


        echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Simples</title>
    <style>
        summary {
            cursor: pointer; /* Change cursor to pointer for better UX */
            font-weight: bold; /* Make the summary text bold */
            margin-bottom: 5px; /* Add some space below the summary */
        }
        details {
            margin-bottom: 15px; /* Add some space between collapsible sections */
            border: 1px solid #ccc; /* Optional: Add a border */
            padding: 10px; /* Optional: Add padding */
            border-radius: 5px; /* Optional: Round the corners */
        }
    </style>
</head>
<body>
$html

</body>
</html>

HTML;
    }

}
