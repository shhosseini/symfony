<?php

namespace NEWS\BlogBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subscribers
 */
class Subscribers
{
    /**
     * @var integer
     */
    private $id;


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
     * @var string
     */
    private $email;

    /**
     * @var \NEWS\BlogBundle\Entity\Category
     */
    private $category;


    /**
     * Set email
     *
     * @param string $email
     * @return Subscribers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set category
     *
     * @param \NEWS\BlogBundle\Entity\Category $category
     * @return Subscribers
     */
    public function setCategory(\NEWS\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \NEWS\BlogBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('email', new Email());
        $metadata->addPropertyConstraint('email', new NotBlank());

        $metadata->addPropertyConstraint('category', new NotBlank());
    }

}
