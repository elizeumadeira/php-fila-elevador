<?php
namespace src;

use src\Descritor;
use src\interface\DescritorInterface;
use src\Persistencia;
use src\traits\GetObject;

class DescritorJsonController implements DescritorInterface
{
    use GetObject;

    public function iniciar($capacidade)
    {
        $elevador = new Elevador($capacidade);
        Persistencia::getInstance()->salvar($elevador, Descritor::serialize);

        echo json_encode([
            'erro'    => false,
            'message' => "Nova Fila criado com capacidade: {$capacidade}",
        ]);

        die();
    }

    public function visualizar()
    {
        $elevador = $this->getElevadorObj();
        $elevadorClone = $elevador->getChamadosPendentes();
        $elevadorClone->setIteratorMode(\SplDoublyLinkedList::IT_MODE_KEEP);

        if ($elevadorClone->isEmpty()) {
            echo json_encode([
                'erro' => false,
                'fila' => [],
            ]);

            die();
        }

        $items = [];
        foreach ($elevadorClone as $item) {
            $items[] = $item;
        }

        echo json_encode([
            'erro' => false,
            'fila' => $items,
        ]);

        die();
    }

    public function chamar($andar)
    {
        if (! isValidInt($andar) || $andar < 0) {
            echo json_encode([
                'erro'    => true,
                'message' => 'É necessário adicionar um número inteiro maior que 1',
            ]);
            die();
        }

        $elevador = $this->getElevadorObj();

        try {
            $elevador->chamar($andar);
        } catch (\Exception $e) {
            echo json_encode([
                'erro'    => true,
                'message' => $e->getMessage(),
            ]);

            die();
        }

        Persistencia::getInstance()->salvar($elevador, Descritor::serialize);

        echo json_encode([
            'erro'    => false,
            'message' => 'Item adicionado',
        ]);

        die();
    }

    public function mover()
    {
        $elevador = $this->getElevadorObj();

        try {
            $elevador->mover();
        } catch (\Exception $e) {
            echo json_encode([
                'erro'    => true,
                'message' => $e->getMessage(),
            ]);

            die();
        }

        Persistencia::getInstance()->salvar($elevador, Descritor::serialize);

        echo json_encode([
            'erro'    => false,
            'message' => 'Item movido',
            'andar'   => $elevador->andarAtual,
        ]);

        die();
    }

    public function andar()
    {
        $elevador = $this->getElevadorObj();

        echo json_encode([
            'erro'  => false,
            'andar' => $elevador->andarAtual,
        ]);

        die();
    }

}
