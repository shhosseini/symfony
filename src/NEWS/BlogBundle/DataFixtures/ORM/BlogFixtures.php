<?php
// src/NEWS/BlogBundle/DataFixtures/ORM/BlogFixtures.php

namespace NEWS\BlogBundle\DataFixtures\ORM;

//use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NEWS\BlogBundle\Entity\Post;

class BlogFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $blog1 = new Post();
        $blog1->setTitle('A day with Symfony2');
        $blog1->setText('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $blog1->setPicture('beach.jpg');
        $blog1->setAuthor('dsyph3r');
        $blog1->setCategory('symfony2');
        $blog1->setCreatedDate(new \DateTime());
        $manager->persist($blog1);


        $blog2 = new Post();
        $blog2->setTitle('The pool on the roof must have a leak');
        $blog2->setText('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        $blog2->setPicture('pool_leak.jpg');
        $blog2->setAuthor('dsdsdasdadyph3r');
        $blog2->setCategory('salam:P');
        $blog2->setCreatedDate(new \DateTime("2011-07-23 06:12:33"));
        $manager->persist($blog2);


        $blog3 = new Post();
        $blog3->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
        $blog3->setText('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $blog3->setPicture('misdirection.jpg');
        $blog3->setAuthor('ds3r');
        $blog3->setCategory('salam:P');
        $blog3->setCreatedDate(new \DateTime("2011-07-16 16:14:06"));
        $manager->persist($blog3);

        $manager->flush();
    }

}