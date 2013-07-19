<?php
// src/NEWS/BlogBundle/Controller/PageController.php

namespace NEWS\BlogBundle\Controller;

use NEWS\BlogBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class TranslateController extends Controller
{

    public function setEnglishAction(){

        $request = $this->getRequest()  ;
        $request->setLocale('en_US');
        $request->getSession()->set('_locale', 'en_US');



        $ref = $request->headers->get('referer');
        $url = substr($ref , strpos($ref, "app_dev.php")+11);
        $temp = $this->get('router')->match($url);
        print_r($temp);

        if (array_key_exists('id' , $temp))
            return $this -> redirect( $this->generateUrl( $temp['_route'] , array('id'=>$temp['id'])) );
        else if (array_key_exists('query' , $temp))
            return $this -> redirect( $this->generateUrl( $temp['_route'] , array('query'=>$temp['query'])) );
        else
            return $this -> redirect( $this->generateUrl( $temp['_route']) );
    }

    public function setFarsiAction(){

        $request = $this->getRequest()  ;
        $request->setLocale('fa_IR');
        $request->getSession()->set('_locale', 'fa_IR');

        $ref = $request->headers->get('referer');
        $url = substr($ref , strpos($ref, "app_dev.php")+11);
        $temp = $this->get('router')->match($url);
        print_r($temp);
        if (array_key_exists('id' , $temp))
            return $this -> redirect( $this->generateUrl( $temp['_route'] , array('id'=>$temp['id'])) );
        else if (array_key_exists('query' , $temp))
            return $this -> redirect( $this->generateUrl( $temp['_route'] , array('query'=>$temp['query'])) );
        else
            return $this -> redirect( $this->generateUrl( $temp['_route']) );


    }


}