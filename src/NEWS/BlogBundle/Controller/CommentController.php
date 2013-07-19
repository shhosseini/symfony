<?php
// src/NEWS/BlogBundle/Controller/CommentController.php

namespace NEWS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use NEWS\BlogBundle\Entity\Comment;
use NEWS\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($blog_id)
    {

        $news = $this->getPost($blog_id);

        $comment = new Comment();
        $comment->setPost($news);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('NEWSBlogBundle:Comment:form.html.twig', array(
            'comment' => $comment,
            'form'   => $form->createView()
        ));
    }

    public function createAction($blog_id)
    {
        //echo $blog_id;
        $news = $this->getPost($blog_id);

        $comment  = new Comment();
        $comment->setPost($news);
        $date = new \DateTime();
        $comment->setSubmitTime($date);
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()
                ->getEntityManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('NEWSBlogBundle_news_show', array(
                    'id' => $comment->getPost()->getId())) .
                    '#comment-' . $comment->getId()
            );
        }

        return $this->render('NEWSBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    protected function getPost($blog_id)
    {
        $em = $this->getDoctrine()
            ->getEntityManager();

        $news = $em->getRepository('NEWSBlogBundle:Post')->find($blog_id);

        if (!$news) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $news;
    }

}