<?php
// src/NEWS/BlogBundle/Form/buildpostform.php

namespace NEWS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class buildpostform extends AbstractType
{
    public function __construct(){

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text', 'textarea');
        //$builder->add('picture');
        $builder->add('picture', 'file',array(
            'attr' => array('class' => 'picClass')
            )
        );

        return $builder->getForm();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NEWS\BlogBundle\Entity\Post'
        ));
    }

    public function getName()
    { // return a unique identifier
        return 'NEWS_blogbundle_buildpostform';
    }
}