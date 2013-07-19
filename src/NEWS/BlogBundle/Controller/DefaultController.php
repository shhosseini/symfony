<?php

namespace NEWS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $all_important_news = $this->getDoctrine()->getEntityManager()->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        return $this->render('NEWSBlogBundle:Default:index.html.twig', array('name' => $name, 'all_important_news' =>$all_important_news ));
    }
}
