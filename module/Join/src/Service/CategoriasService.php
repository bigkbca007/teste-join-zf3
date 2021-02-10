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

}