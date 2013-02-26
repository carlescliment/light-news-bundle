<?php

namespace BladeTester\LightNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use BladeTester\LightNewsBundle\Form\Type\NewsFormType;
use BladeTester\LightNewsBundle\Entity\News;

class AdminController extends Controller
{
    /**
     * @Template()
     */
    public function addAction()
    {
    	$news = new News;
		$form = $this->createForm($this->get('blade_tester_light_news.forms.news'), $news);
        return array('form' => $form->createView());
    }
}
