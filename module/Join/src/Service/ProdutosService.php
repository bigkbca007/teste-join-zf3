<?php

namespace Join\Service;

use Join\Entity\TbProdutos;
use Join\Service\AbstractService;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * Classe para realizar transações com o a tabela tb_produto
 */
class ProdutosService extends AbstractService {

    public function __construct($container, $entityManager) {
        $this->container = $container;
        $this->entityManager = $entityManager;
        $this->entity = TbProdutos::class;
    }

}