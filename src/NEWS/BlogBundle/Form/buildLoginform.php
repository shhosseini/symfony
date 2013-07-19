<?php
// src/NEWS/BlogBundle/Form/Login.php

namespace NEWS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class buildLoginform extends AbstractType
{
    public function __construct(){

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
        $builder->add('password', 'password');
        return $builder->getForm();
    }

    public function getName()
    { // return a unique identifier
        return 'NEWS_blogbundle_buildLoginform';
    }
}