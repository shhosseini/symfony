<?php
// src/NEWS/BlogBundle/Form/buildSubscribeForm.php

/**
 * Created by JetBrains PhpStorm.
 * User: Z.Zeinoddini
 * Date: 17/07/13
 * Time: 00:08
 * To change this template use File | Settings | File Templates.
 */


namespace NEWS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class buildSubscribeForm extends AbstractType
{
    public function __construct(){

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email');
        $builder->add('category');

        return $builder->getForm();
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NEWS\BlogBundle\Entity\Subscribers'
        ));
    }
    public function getName()
    { // return a unique identifier
        return 'Subscribe_Form';
    }


}