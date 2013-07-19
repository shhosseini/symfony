<?php
// src/NEWS/BlogBundle/Controller/PageController.php

namespace NEWS\BlogBundle\Controller;

use NEWS\BlogBundle\Entity;
use NEWS\BlogBundle\Entity\Post;
use NEWS\BlogBundle\Entity\Author;
use NEWS\BlogBundle\Entity\Subscribers;
use NEWS\BlogBundle\Form\buildpostform;
use NEWS\BlogBundle\Form\buildLoginform;
use NEWS\BlogBundle\Form\buildRegForm;
use NEWS\BlogBundle\Form\buildSubscribeForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class PageController extends Controller
{
    public function indexAction()
    {
        $request = $this->getRequest()  ;
        if ($request->getSession()->get('_locale') == 'en_US'){
            $request->setLocale('en_US');
        }
        else
        {
            $request->setLocale('fa_IR');
        }
        $em = $this->getDoctrine()
            ->getEntityManager();

        $news = $em->createQueryBuilder()
            ->select('b')
            ->from('NEWSBlogBundle:Post',  'b')
            ->addOrderBy('b.createdDate', 'DESC')
            ->getQuery()
            ->getResult();

        $all_important_news = $em->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        return $this->render('NEWSBlogBundle:Page:index.html.twig', array(
            'all_news' => $news,
            'all_important_news' => $all_important_news
        ));
    }
    public function aboutAction()
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

        return $this->render('NEWSBlogBundle:Page:about.html.twig' , array(
            'all_important_news' => $all_important_news
        ));
    }

    public function newpostAction()
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
        $all_important_news = $em->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        $post = new Post();
//        $user = $this->getUser();
//        $post->setAuthor($user);

        $form = $this->createForm(new buildpostform(), $post);


        return $this->render('NEWSBlogBundle:Page:newpost.html.twig', array(
            'form' => $form->createView(),
            'all_important_news' => $all_important_news
        ));
    }

    public function submitNewPostAction()
    {

    }
    public function editPictureAction()
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

        $newPost = new Post();

        $user = $this->getUser();
        $date = new \DateTime();
        $user_obj = $em->getRepository('NEWSBlogBundle:Author')->find($user);
        $category_id = $user_obj->getCategory();

        $newPost->setAuthor($user);
        $newPost->setCategory($category_id);
        $newPost->setCreatedDate($date);

        $form = $this->createForm(new buildpostform(), $newPost);
        $form->bind($this->getRequest());

        $all_important_news = $em->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        if ($form->isValid()) {

            $post = $form->getData();

            //upload picture in system
            $dir = "C:/Users/sony/PhpstormProjects/symfony/web/images";
            // use the original file name
            $file = $form['picture']->getData();
            $file->move($dir, $file->getClientOriginalName());
            $post->setPicPath($file->getClientOriginalName()); //keep picture address

            $em->persist($post);
            $em->flush();

            $post = $em->getRepository('NEWSBlogBundle:Post')->findOneBy(array('createdDate' => $date));
            $post_id = $post->getId();

            $subscribers = $em->getRepository('NEWSBlogBundle:Subscribers')->findEmailsByCategory($category_id);

            foreach($subscribers as $email)
            {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Updates in Symfony Blog')
                    ->setFrom(array('blog@symfonyblog.com' => 'Symfony Blog'))
                    ->setTo($email["email"])
                    ->setBody(
                    $this->renderView(
                        'NEWSBlogBundle:Default:email.txt.twig',
                        array('url' => $post_id)
                    )
                )
                ;
                $this->get('mailer')->send($message);

           }

            return $this->redirect($this->generateUrl('NEWSBlogBundle_homepage'));
        }


        return $this->render(
            'NEWSBlogBundle:Page:newpost.html.twig', array(
            'form' => $form->createView(),
            'all_important_news' => $all_important_news
        ));
    }





    public function showAction($id)
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
        $news = $em->getRepository('NEWSBlogBundle:Post')->find($id);

        $all_important_news = $em->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        if (!$news) {
            echo('Unable to find Blog post.');
        }

        $news->increaseViewTimes();
        $em->flush();

        $comments = $em->getRepository('NEWSBlogBundle:Comment')
            ->getCommentsForNews($id);

        return $this->render('NEWSBlogBundle:Page:show.html.twig', array(
            'news' => $news,
            'comments'  => $comments,
            'all_important_news' => $all_important_news

        ));
    }

    public function subscribeAction(){

        $request = $this->getRequest()  ;
        if ($request->getSession()->get('_locale') == 'en_US'){
            $request->setLocale('en_US');
        }
        else
        {
            $request->setLocale('fa_IR');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $all_important_news = $em->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        $form = $this->createForm( new buildSubscribeForm(), new Subscribers());


        return $this->render(
            'NEWSBlogBundle:Page:subscribe.html.twig', array(
            'form' => $form->createView(),
            'all_important_news' => $all_important_news
        ));

    }

    public function submitSubscribeAction()
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
        $all_important_news = $em->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();
        $form = $this->createForm(new buildSubscribeForm(), new Subscribers());
        $form->bind($this->getRequest());

        if ($form->isValid()) {
            $subscription = $form->getData();

            $em->persist($subscription);
            $em->flush();

            return $this->redirect($this->generateUrl('NEWSBlogBundle_homepage'));
        }


        return $this->render(
            'NEWSBlogBundle:Page:subscribe.html.twig', array(
            'form' => $form->createView(),
            'all_important_news' => $all_important_news
        ));
    }

    public function editPicAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $news = $em->getRepository('NEWSBlogBundle:Post')->find($id);
        if (!$news) {
            echo('Unable to find Blog post.');
        }
        return $this->render('NEWSBlogBundle:Page:editPic.html.twig',array(
        'news' => $news,
        ));
    }


}