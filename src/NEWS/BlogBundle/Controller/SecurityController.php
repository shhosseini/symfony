<?php
//// src/NEWS/BlogBundle/Controller/SecurityController.php;
//
///**
// * Created by JetBrains PhpStorm.
// * User: Z.Zeinoddini
// * Date: 20/06/13
// * Time: 15:30
// * To change this template use File | Settings | File Templates.
// */
//
//namespace NEWS\BlogBundle\Controller;
//
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Security\Core\SecurityContext;
//
//class SecurityController extends Controller
//{
//    public function loginAction()
//    {
//        $request = $this->getRequest();
//        $session = $request->getSession();
//
//        // get the login error if there is one
//        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
//            $error = $request->attributes->get(
//                SecurityContext::AUTHENTICATION_ERROR
//            );
//        } else {
//            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
//            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
//        }
//
//        return $this->render(
//            'AcmeSecurityBundle:Security:login.html.twig',
//            array(
//                // last username entered by the user
//                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
//                'error'         => $error,
//            )
//        );
//    }
//}