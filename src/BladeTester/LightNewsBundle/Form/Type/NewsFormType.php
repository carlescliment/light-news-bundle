<?php

namespace BladeTester\LightNewsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsFormType extends AbstractType {

    protected $dataClass;

    public function __construct($dataClass)
    {
        $this->dataClass = $dataClass;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt', 'datetime', array(
                'label' => 'bladetester_lightnews.label.news.created'
            ))
            ->add('title', 'text', array(
                'label' => 'bladetester_lightnews.label.news.title'
            ))
            ->add('body', 'textarea', array(
                'label' => 'bladetester_lightnews.label.news.body'
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'bladetester_lightnews_news';
    }


    public function getDefaultOptions(array $options) {
        return array(
          'data_class' => $this->dataClass,
        );
    }


}