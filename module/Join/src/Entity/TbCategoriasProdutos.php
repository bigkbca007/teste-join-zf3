<?php

namespace Join\Entity;

use Doctrine\ORM\Mapping as ORM;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * TbCategoriasProdutos
 *
 * @ORM\Table(name="tb_categorias_produtos")
 * @ORM\Entity
 */
class TbCategoriasProdutos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categoria_produto", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategoriaProduto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_categoria", type="string", length=150, nullable=false)
     */
    private $nomeCategoria;

    /**
     * Constructor
     */
    public function __construct($data = null)
    {
        $hydrator = new ClassMethodsHydrator();
        $hydrator->hydrate($data, $this);
    }

    public function toArray()
    {
        $hydrator = new ClassMethodsHydrator();
        return $hydrator->extract($this);
    }

    public function getIdCategoriaProduto(): int
    {
        return $this->idCategoriaProduto;
    }

    public function getNomeCategoria(): string
    {
        return $this->nomeCategoria;
    }

    public function setIdCategoriaProduto(int $idCategoriaProduto)
    {
        $this->idCategoriaProduto = $idCategoriaProduto;
        return $this;
    }

    public function setNomeCategoria(string $nomeCategoria)
    {
        $this->nomeCategoria = $nomeCategoria;
        return $this;
    }
}
