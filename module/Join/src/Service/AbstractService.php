<?php

namespace Join\Service;

use Laminas\Hydrator\ClassMethodsHydrator;

abstract class AbstractService {
    protected $container;
    protected $entityManager;
    protected $entity;

    public function store(array $data){
        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function update(array $data, int $id){
        $entity = $this->entityManager->getReference($this->entity, $id);
        $hydrator = new ClassMethodsHydrator();
        $hydrator->hydrate($data, $entity);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    public function destroy(int $id){
        
        $entity = $this->entityManager->getReference($this->entity, $id);

        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return $entity;
    }
}