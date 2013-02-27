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


    public function create($title = '', $body = '') {
        $news = $this->build($title, $body);
        $this->persist($news);
        return $news;
    }

    public function build($title = '', $body = '') {
        $news = clone($this->serviceContainer->get('blade_tester_light_news.entity.news'));
        $news->setTitle($title);
        $news->setBody($body);
        return $news;
    }

    public function update(NewsInterface $news) {
        $news->setUpdatedAt(new \DateTime);
        $this->getObjectManager()->flush();
        return $news;
    }

    public function persist(NewsInterface $news) {
        $om = $this->getObjectManager();
        $om->persist($news);
        $om->flush();
        return $news;
    }

    public function remove(NewsInterface $news)
    {
        $om = $this->getObjectManager();
        $om->remove($news);
        $om->flush();
        return $news;
    }

    public function refresh(NewsInterface $news)
    {
        $om = $this->getObjectManager();
        $om->refresh($news);
        return $news;
    }

    public function find($id) {
        return $this->getRepository()->find($id);
    }

    public function findAll() {
        return $this->getRepository()->findAll();
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getRepository() {
        return $this->getObjectManager()->getRepository($this->class);
    }

    private function getObjectManager() {
        return $this->serviceContainer->get('doctrine.orm.entity_manager');
    }

}
