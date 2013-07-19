<?php
// src/NEWS/BlogBundle/Controller/UserController.php

namespace NEWS\BlogBundle\Controller;

use NEWS\BlogBundle\Entity;
use NEWS\BlogBundle\Entity\Post;
use NEWS\BlogBundle\Entity\Author;
use NEWS\BlogBundle\Form\buildpostform;
use NEWS\BlogBundle\Form\buildLoginform;
use NEWS\BlogBundle\Form\buildRegForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;


class UserController extends Controller
{

    public function registrationAction()
    {

        $request = $this->getRequest()  ;
        if ($request->getSession()->get('_locale') == 'en_US'){
            $request->setLocale('en_US');
        }
        else
        {
            $request->setLocale('fa_IR');
        }

        $form = $this->createForm( new buildRegForm(), new Author    );
        $all_important_news = $this->getDoctrine()->getEntityManager()->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();


        return $this->render(
            'NEWSBlogBundle:User:registration.html.twig', array(
                'form' => $form->createView(),
                'all_important_news' => $all_important_news
            ));
    }

    public function createAction()
    {
        $request = $this->getRequest()  ;
        if ($request->getSession()->get('_locale') == 'en_US'){
            $request->setLocale('en_US');
        }
        else
        {
            $request->setLocale('fa_IR');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $form = $this->createForm(new buildRegForm(), new Author());
        $form->bind($this->getRequest());
        $all_important_news = $em->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        if ($form->isValid()) {
            $registration = $form->getData();

            $em->persist($registration);
            $em->flush();

            return $this->redirect($this->generateUrl('NEWSBlogBundle_homepage'));
        }


        return $this->render(
            'NEWSBlogBundle:User:registration.html.twig', array(
                'form' => $form->createView(),
                'all_important_news' => $all_important_news
            ));
    }



    public function LoginAction()
    {
        $request = $this->getRequest()  ;
        if ($request->getSession()->get('_locale') == 'en_US'){
            $request->setLocale('en_US');
        }
        else
        {
            $request->setLocale('fa_IR');
        }

        $all_important_news = $this->getDoctrine()->getEntityManager()->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        if( !$this->container->get('security.context')  ->isGranted('IS_AUTHENTICATED_FULLY') ){
            $request = $this->getRequest();
            $session = $request->getSession();

            // get the login error if there is one
            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(
                    SecurityContext::AUTHENTICATION_ERROR
                );

            } else {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            }

            return $this->render(
                'NEWSBlogBundle:User:Login.html.twig',
                array(
                    // last username entered by the user
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error'         => $error,
                    'all_important_news' => $all_important_news
                )
            );
        }
        else{
            return $this->redirect($this->generateUrl('NEWSBlogBundle_homepage'));
        }

    }


    public function logAction(){

        $request = $this->getRequest()  ;
        if ($request->getSession()->get('_locale') == 'en_US'){
            $request->setLocale('en_US');
        }
        else
        {
            $request->setLocale('fa_IR');
        }

        if( $this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ){
            // authenticated (NON anonymous)
            return $this->redirect($this->generateUrl('NEWSBlogBundle_logout'));
        }
        else {
            return $this->redirect($this->generateUrl('NEWSBlogBundle_Login'));
        }

    }


}