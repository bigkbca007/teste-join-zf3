<?php

namespace Join\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Stmt\ClassMethod;
use Laminas\Hydrator\ClassMethodsHydrator;

/**
 * TbProdutos
 *
 * @ORM\Table(name="tb_produtos", indexes={@ORM\Index(name="tb_produtos_id_categoria_produto_foreign", columns={"id_categoria_produto"})})
 * @ORM\Entity(repositoryClass="Join\Repository\TbProdutosRepository")
 */
class TbProdutos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_produto", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProduto;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_produto", type="string", length=150, nullable=false)
     */
    private $nomeProduto;

    /**
     * @var float
     *
     * @ORM\Column(name="valor_produto", type="float", precision=10, scale=2, nullable=false)
     */
    private $valorProduto;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data_criacao", type="datetime", nullable=true)
     */
    private $dataCriacao;

    /**
     * @var \Join\Entity\TbCategoriasProdutos
     *
     * @ORM\ManyToOne(targetEntity="Join\Entity\TbCategoriasProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria_produto", referencedColumnName="id_categoria_produto")
     * })
     */
    private $idCategoriaProduto;

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
    
    public function getIdProduto(): int {
        return $this->idProduto;
    }

    public function getNomeProduto(): string {
        return $this->nomeProduto;
    }

    public function getValorProduto(): float {
        return $this->valorProduto;
    }

    public function getDataCriacao(): ?\DateTime {
        return $this->dataCriacao;
    }

    public function getIdCategoriaProduto(): \Join\Entity\TbCategoriasProdutos {
        return $this->idCategoriaProduto;
    }

    public function setIdProduto(int $idProduto) {
        $this->idProduto = $idProduto;
        return $this;
    }

    public function setNomeProduto(string $nomeProduto) {
        $this->nomeProduto = $nomeProduto;
        return $this;
    }

    public function setValorProduto(float $valorProduto) {
        $this->valorProduto = $valorProduto;
        return $this;
    }

    public function setDataCriacao(?\DateTime $dataCriacao) {
        $this->dataCriacao = $dataCriacao;
        return $this;
    }

    public function setIdCategoriaProduto(\Join\Entity\TbCategoriasProdutos $idCategoriaProduto) {
        $this->idCategoriaProduto = $idCategoriaProduto;
        return $this;
    }
    
}
