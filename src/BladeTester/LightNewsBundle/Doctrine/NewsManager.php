<?php

namespace BladeTester\LightNewsBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use BladeTester\LightNewsBundle\Model\NewsInterface;

class NewsManager
{
    protected $serviceContainer;
    protected $class;

    public function __construct($service_container, $class)
    {
        $this->serviceContainer = $service_container;
        $metadata = $this->getObjectManager()->getClassMetadata($class);
        $this->class = $metadata->getName();
    }


    public function build() {
        return $this->serviceContainer->get('blade_tester_light_news.entity.news');
    }

    public function persist(NewsInterface $news) {
        $om = $this->getObjectManager();
        $om->persist($news);
        $om->flush();
    }

    public function remove(NewsInterface $news)
    {
        $om = $this->getObjectManager();
        $om->remove($news);
        $om->flush();
    }

    public function find($id) {
        return $this->getRepository()->find($id);
    }

    public function getClass()
    {
        return $this->class;
    }

    private function getRepository() {
        return $this->getObjectManager()->getRepository($this->class);
    }

    private function getObjectManager() {
        return $this->serviceContainer->get('doctrine.orm.entity_manager');
    }

}
