<?php

namespace Join\Service;

use Join\Entity\TbCategoriasProdutos;
use Join\Service\AbstractService;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * Classe para realizar transações com o a tabela tb_categorias_produtos
 */
class CategoriasService extends AbstractService {

    public function __construct($container, $entityManager) {
        $this->container = $container;
        $this->entityManager = $entityManager;
        $this->entity = TbCategoriasProdutos::class;
    }

    /**
     * Método para inserir categoria em tb_categorias_produtos
     */
    public function store(array $data){

        return parent::store($data, TbCategoriasProdutos::class);
    }

    /**
     * Método para atualizar uma categoria em tb_categorias_produtos
     */
    public function update(array $data, int $id){

        return parent::update($data, $id, TbCategoriasProdutos::class);
    }

    /**
     * Método para remover um registro de tb_categorias_produtos
     */
    public function destroy(int $id){
        
        return parent::destroy($id);
    }
}