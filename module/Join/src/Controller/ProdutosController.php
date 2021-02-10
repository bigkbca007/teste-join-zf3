<?php

namespace Join\Controller;

use Join\Entity\TbCategoriasProdutos;
use Join\Entity\TbProdutos;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class ProdutosController extends AbstractActionController {

    private $container;
    private $entityManager;

    public function __construct($container, $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->container= $container;
    }

    public function criarAction()
    {

        $categorias = $this->entityManager->getRepository(TbCategoriasProdutos::class)->findBy([],['nomeCategoria' => 'ASC']);

        return [
            'produto' => null,
            'categorias' => $categorias,
            'action' => '/produtos/store'
        ];
        
    }

    public function indexAction()
    {
        $produtos = $this->entityManager->getRepository(TbProdutos::class)->getProdutos();

        return [
            'produtos' => $produtos
        ];
    }

    public function storeAction(){
        // Filtragem aqui
        
        $data = $this->params()->fromPost();
        unset($data['idProduto']);
        $data['valorProduto'] = (float)str_replace(['.',','], ['','.'], $data['valorProduto']);
        $data['dataCriacao'] = new \DateTime('now', new \DateTimeZone('America/Bahia'));
        $data['idCategoriaProduto'] = $this->entityManager->getReference(TbCategoriasProdutos::class, $data['idCategoriaProduto']);
        
        $service = $this->container->get('produtos-service');

        $service->store($data);

        return $this->redirect()->toUrl('/produtos');

    }

    public function editAction(){
        $id = $this->params()->fromRoute('id');
        
        $produto = $this->entityManager->getRepository(TbProdutos::class)->find($id);
        $categorias = $this->entityManager->getRepository(TbCategoriasProdutos::class)->findBy([],['nomeCategoria' => 'ASC']);

        $view = new ViewModel([
            'produto' => $produto,
            'categorias' => $categorias,
            'action' => '/produtos/update'
        ]);
        $view->setTemplate('join/produtos/criar');
        
        return $view;
    }

    public function updateAction(){
        // Filtragem aqui

        $data = $this->params()->fromPost();
        $id = $data['idProduto'] = (int)$data['idProduto'];
        $data['valorProduto'] = (float)str_replace(['.',','], ['','.'], $data['valorProduto']);
        $data['idCategoriaProduto'] = $this->entityManager->getReference(TbCategoriasProdutos::class, $data['idCategoriaProduto']);
        
        $service = $this->container->get('produtos-service');
        $service->update($data, $id);

        return $this->redirect()->toUrl('/produtos');

    }

    public function destroyAction(){
        $id = $this->params()->fromRoute('id');

        // Verificar ser o registro exites. Se não existir, então exibe mensagem de erro.

        $service = $this->container->get('produtos-service');
        
        $service->destroy($id);

        return $this->redirect()->toUrl('/produtos');

    }

}