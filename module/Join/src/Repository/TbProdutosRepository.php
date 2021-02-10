<?php

namespace Join\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Join\Entity\TbCategoriasProdutos;

class TbProdutosRepository extends EntityRepository
{
    public function getProdutos(){
        $qb = $this->createQueryBuilder('p');
        $qb
            ->select('
                p.idProduto,
                p.nomeProduto,
                p.valorProduto,
                p.dataCriacao,
                c.nomeCategoria
            ')
            ->innerJoin(TbCategoriasProdutos::class, 'c', Join::WITH, 'p.idCategoriaProduto = c.idCategoriaProduto')
            ->orderBy('p.nomeProduto', 'ASC');

        return $qb->getQuery()->getResult();
    }
}