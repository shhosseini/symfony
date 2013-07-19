<?php
namespace NEWS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

use NEWS\BlogBundle\Entity\Post;
use NEWS\BlogBundle\Form\PostType;
use NEWS\BlogBundle\Form\PostHandler;

class SearchEngineController extends Controller
{


    public function searchAction()
    {
        // Generation of the form
        $form = $this->container->get('form.factory')->createBuilder(new PostType())->getForm();

        // return the form view
        $all_important_news = $this->getDoctrine()->getEntityManager()
            ->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        return $this->render('NEWSBlogBundle:Page:index.html.twig', array(
            'form' => $form->createView(),
            'all_important_news' => $all_important_news
        ));
    }

    public function getResultsAction()
    {
        // We recover the user request
        $request = $this->container->get('request');

        // We need to create again a form object for the formHandler
        $form = $this->container->get('form.factory')->createBuilder(new PostType())->getForm();

        $formHandler = new PostHandler($form, $request, $this->getDoctrine()->getManager());

        if ($formHandler->process()) {

            // title sent
            $title = $form['title']->getData();

            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('NEWSBlogBundle:Post');

            // we get the movies thanks to our custom query (cf repository)
            $posts_list = $repository->searchPost( $title );
            $all_important_news = $this->getDoctrine()->getEntityManager()
                ->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();
            // return the results view
            return $this->render('NEWSBlogBundle:SearchEngine:results.html.twig', array(
                'posts' => $posts_list,
                'all_important_news' => $all_important_news
            ));
        }
        $all_important_news = $this->getDoctrine()->getEntityManager()
            ->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();

        // return the form view
        return $this->render('NEWSBlogBundle:Page:index.html.twig', array(
            'form' => $form->createView(),
            'all_important_news' => $all_important_news
        ));
    }


/*    public function searchActiona()
    {
        // Generation of the form
        $form = $this->container->get('form.factory')->createBuilder(new PostType())->getForm();

        // We recover the user request
        $request = $this->container->get('request');

        if ($request->getMethod() == 'POST') {

            $formHandler = new PostHandler($form, $request, $this->getDoctrine()->getManager());

            // this variable contains a boolean which indicate if there are errors or not
            if($formHandler->process()){

                // title sent
                $title = $form['title']->getData();
                $repository = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('NEWSBlogBundle:Post');

                // we get the movies thank to our custom query (cf repository)
                $posts_list = $repository->searchPost( $title );

                $all_important_news = $this->getDoctrine()->getEntityManager()
                    ->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();
                // return the results view
                return $this->render('NEWSBlogBundle:Page:results.html.twig', array(
                    'posts' => $posts_list,
                    'all_important_news' => $all_important_news
                ));
            }
        }
        $all_important_news = $this->getDoctrine()->getEntityManager()
            ->getRepository('NEWSBlogBundle:Post')->findAllOrderedByTimesViewed();
        // return the form view
        return $this->render('NEWSBlogBundle:Page:index.html.twig', array(
            'form' => $form->createView(),
            'all_important_news' => $all_important_news
        ));
    }


    public function getAjaxResultsActiona()
    {
        $request = $this->container->get('request');

        if($request->isXmlHttpRequest())
        {
            // get title sent ($_GET)
            $term = $request->query->get('term');

            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('NEWSBlogBundle:Post');
            $posts_list = $repository->searchPost( $term );

            $post_titles = array();
            foreach ($posts_list  as $post) {
                $post_titles[] = $post->getTitle();
            }

            return new JsonResponse($post_titles );
        }
    }*/

}