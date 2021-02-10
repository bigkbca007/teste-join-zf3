<?php

namespace Join\Controller;

use Join\Entity\TbCategoriasProdutos;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use stdClass;

class CategoriasController extends AbstractActionController {

    private $container;
    private $entityManager;

    public function __construct($container, $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->container= $container;
    }

    public function criarAction()
    {

        return [
            'categoria' => null,
            'action' => '/categorias/store'
        ];
    }

    public function indexAction()
    {
        $categorias = $this->entityManager->getRepository(TbCategoriasProdutos::class)->getCategorias();

        return [
            'categorias' => $categorias
        ];
    }

    public function storeAction(){
        // Filtragem aqui
        
        $data = $this->params()->fromPost();
        unset($data['idCategoriaProduto']);
        
        $service = $this->container->get('categorias-service');

        $service->store($data);

        return $this->redirect()->toUrl('/categorias');

    }

    public function editAction(){
        $id = $this->params()->fromRoute('id');
        
        $categoria = $this->entityManager->getRepository(TbCategoriasProdutos::class)->find($id);

        $view = new ViewModel([
            'categoria' => $categoria,
            'action' => '/categorias/update'
        ]);
        $view->setTemplate('join/categorias/criar');
        
        return $view;
    }

    public function updateAction(){
        // Filtragem aqui
        
        $data = $this->params()->fromPost();
        $data['idCategoriaProduto'] = (int)$data['idCategoriaProduto'];
        $id = (int)$data['idCategoriaProduto'];
        $service = $this->container->get('categorias-service');
        
        $service->update($data, $id);

        return $this->redirect()->toUrl('/categorias');

    }

    public function destroyAction(){
        $id = $this->params()->fromRoute('id');

        // Verificar ser o registro exites. Se não existir, então exibe mensagem de erro.

        $service = $this->container->get('categorias-service');
        try{
            $service->destroy($id);
        } catch(\Exception $e){
            echo 'Esta categoria não pode ser removida<br>';
            echo '<a href="javascript:history.back();">Voltar</a>';
            die;
        }

        return $this->redirect()->toUrl('/categorias');

    }

}