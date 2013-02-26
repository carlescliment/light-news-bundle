<?php

namespace BladeTester\LightNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


use BladeTester\LightNewsBundle\Form\Type\NewsFormType;
use BladeTester\LightNewsBundle\Entity\News;

class AdminController extends Controller
{
    /**
     * @Template()
     */
    public function addAction(Request $request)
    {
        $news = $this->get('blade_tester_light_news.entity.news');
		$form = $this->createForm($this->get('blade_tester_light_news.forms.news'), $news);
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($news);
                $em->flush();
                $translator = $this->get('translator');
                $this->get('session')->setFlash('notice', $translator->trans('bladetester_lightnews.system_message.news.add'));
                return $this->redirect($this->generateUrl('news_add'));
            }
        }
        return array('form' => $form->createView());
    }


}
