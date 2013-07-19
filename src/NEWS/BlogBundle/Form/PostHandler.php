<?php
namespace NEWS\BlogBundle\Form;


use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

use NEWS\BlogBundle\Entity\Post;

class PostHandler
{
    protected $form;
    protected $request;
    protected $em;

    public function __construct(Form $form, Request $request, EntityManager $em){
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    public function process(){
        if( $this->request->getMethod() == 'POST' ){
            $this->form->bindRequest($this->request);
            if ($this->form->isValid()) {
                return true;
            }
            else {
                return false;
            }
        }
        return false;
    }
}