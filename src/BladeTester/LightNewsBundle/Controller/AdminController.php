<?php

namespace BladeTester\LightNewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $manager = $this->getNewsManager();
        $news = $manager->build();
        $form = $this->createForm($this->get('blade_tester_light_news.forms.news'), $news);
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $manager->persist($news);
                $translator = $this->get('translator');
                $this->get('session')->setFlash('notice', $translator->trans('bladetester_lightnews.system_message.news.add'));
                return $this->redirect($this->generateUrl('news_add'));
            }
        }
        return array('form' => $form->createView());
    }


    public function removeAction($id) {
        $manager = $this->getNewsManager();
        $news = $manager->find($id);
        $manager->remove($news);
        $translator = $this->get('translator');
        $this->get('session')->setFlash('notice', $translator->trans('bladetester_lightnews.system_message.news.remove'));
        return $this->redirect($this->generateUrl('news_homepage'));
    }

    /**
     * @Template()
     */
    public function editAction($id, Request $request) {
        $manager = $this->getNewsManager();
        $news = $manager->find($id);
        $form = $this->createForm($this->get('blade_tester_light_news.forms.news'), $news);
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $manager->update($news);
                $translator = $this->get('translator');
                $this->get('session')->setFlash('notice', $translator->trans('bladetester_lightnews.system_message.news.update'));
                return $this->redirect($this->generateUrl('news_edit', array('id' => $id)));
            }
        }
        return array('form' => $form->createView(),
                    'news' => $news);
    }

    /**
     * @Template()
     */
    public function listAction() {
        $manager = $this->getNewsManager();
        $news = $manager->findBy(array(), array('createdAt' => 'DESC'));
        return array('news' => $news);
    }

    private function getNewsManager() {
        return $this->get('blade_tester_light_news.news_manager');
    }


}
