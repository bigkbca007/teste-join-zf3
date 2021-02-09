<?php

namespace Join\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Helper\ViewModel;
use stdClass;

class CategoriasController extends AbstractActionController {

    public function criarAction()
    {

        return [
            'categoria' => null,
            'action' => '/categorias/store'
        ];
        
    }

    public function indexAction()
    {
        //--------------------------------------------
        // Acessar bd
        //--------------------------------------------
        $obj = new stdClass();
        $obj->nome_categoria = 'Jogos';
        $obj->id_categoria_produto = 'Jogos';

        $categorias = [$obj];
        //---------------------------------------------
        return [
            'categorias' => $categorias
        ];
    }
}