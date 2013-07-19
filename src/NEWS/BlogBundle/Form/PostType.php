<?php
namespace NEWS\BlogBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('title');
    }

    public function getName(){
        return 'NEWS_BlogBundle_PostType';
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => "NEWS\BlogBundle\Entity\Post",
            'intention' => 'search',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'validation_groups' => array('search_field'),
        );
    }
}