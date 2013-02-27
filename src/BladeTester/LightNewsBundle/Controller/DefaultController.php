<?php

namespace BladeTester\LightNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Template()
     */
    public function indexAction()
    {
        $manager = $this->getNewsManager();
        $news = $manager->findAll();
        return array('news' => $news);
    }


    /**
     * @Template()
     */
    public function viewAction($id)
    {
        $manager = $this->getNewsManager();
        $news = $manager->find($id);
        return array('news' => $news);
    }

    private function getNewsManager() {
        return $this->get('blade_tester_light_news.news_manager');
    }
}
