<?php
// src/NEWS/BlogBundle/Form/buildRegForm.php

namespace NEWS\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class buildRegForm extends AbstractType
{
    public function __construct(){

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Name' , 'text');
        $builder->add('Surname' , 'text');
        $builder->add('username', 'text');
        $builder->add('password', 'repeated', array(
            'first_name'  => 'password',
            'second_name' => 'confirm',
            'type'        => 'password',));
        $builder->add('category');

        return $builder->getForm();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NEWS\BlogBundle\Entity\Author'
        ));
    }

    public function getName()
    { // return a unique identifier
        return 'Author';
    }


}