<?php

namespace Join\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Helper\ViewModel;
use stdClass;

class ProdutosController extends AbstractActionController {

    public function criarAction()
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
            'produto' => null,
            'categorias' => $categorias,
            'action' => '/produtos/store'
        ];
        
    }

    public function indexAction()
    {
        //--------------------------------------------
        // Acessar bd
        //--------------------------------------------
        $obj = new stdClass();
        $obj->nome_produto = 'Dark Souls III';
        $obj->nome_categoria = 'Jogos';
        $obj->valor_produto = '250.99';
        $obj->data_criacao = '09/02/2021 17:26:38';
        $obj->id_produto = '1';

        $produtos = [$obj];
        //---------------------------------------------
        return [
            'produtos' => $produtos
        ];
    }
}