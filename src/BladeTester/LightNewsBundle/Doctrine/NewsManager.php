<?php

namespace BladeTester\LightNewsBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use BladeTester\LightNewsBundle\Model\NewsInterface;

class NewsManager
{
    protected $objectManager;
    protected $class;
    protected $repository;

    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);
        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    public function remove(NewsInterface $news)
    {
        $this->objectManager->remove($news);
        $this->objectManager->flush();
    }

    public function find($id) {
        return $this->repository->find($id);
    }

    public function getClass()
    {
        return $this->class;
    }

}
