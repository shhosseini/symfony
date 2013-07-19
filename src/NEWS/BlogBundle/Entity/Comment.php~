<?php

namespace NEWS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $text;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }
    /**
     * @var \DateTime
     */
    private $submitTime;


    /**
     * Set submitTime
     *
     * @param \DateTime $submitTime
     * @return Comment
     */
    public function setSubmitTime($submitTime)
    {
        $this->submitTime = $submitTime;

        return $this;
    }

    /**
     * Get submitTime
     *
     * @return \DateTime 
     */
    public function getSubmitTime()
    {
        return $this->submitTime;
    }
    /**
     * @var \NEWS\BlogBundle\Entity\Post
     */
    private $post;


    /**
     * Set post
     *
     * @param \NEWS\BlogBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\NEWS\BlogBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \NEWS\BlogBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
    /**
     * @var string
     */
    private $name;


    /**
     * Set name
     *
     * @param string $name
     * @return Comment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank(array(
            'message' => 'You must enter your name'
        )));
        $metadata->addPropertyConstraint('text', new NotBlank(array(
            'message' => 'You must enter a comment'
        )));
    }
}
