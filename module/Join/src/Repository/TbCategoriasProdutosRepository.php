<?php

namespace Join\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Join\Entity\TbProdutos;

class TbCategoriasProdutosRepository extends EntityRepository
{
    public function getCategorias(){
        $qb = $this->createQueryBuilder('c');
        $qb
            ->select('
                c.idCategoriaProduto,
                c.nomeCategoria,
                p.idProduto
            ')
            ->leftJoin(TbProdutos::class, 'p', Join::WITH, 'c.idCategoriaProduto = p.idCategoriaProduto')
            ->orderBy('c.nomeCategoria', 'ASC');

        return $qb->getQuery()->getResult();
    }
}