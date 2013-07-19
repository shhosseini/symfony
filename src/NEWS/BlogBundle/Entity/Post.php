<?php

namespace NEWS\BlogBundle\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\MinLength;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \stdClass
     */
    private $picture;

    /**
     * @var \NEWS\BlogBundle\Entity\Category
     */
    private $category;


    /**
     * @var integer
     */
    private $numberOfComments;

    /**
     * @var integer
     */
    private $numberOfTimesViewed;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->numberOfTimesViewed = 0;
        $this->numberOfComments=0;
    }

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
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Post
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
     * Set createdDate
     *
     * @param \DateTime $createdDate
     * @return Post
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set picture
     *
     * @param \stdClass $picture
     * @return Post
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \stdClass
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set category
     *
     * @param \NEWS\BlogBundle\Entity\Category $category
     * @return Post
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


    /**
     * Set numberOfTimesViewed
     *
     * @param integer $numberOfTimesViewed
     * @return Post
     */
    public function setNumberOfTimesViewed($numberOfTimesViewed)
    {
        $this->numberOfTimesViewed = $numberOfTimesViewed;

        return $this;
    }

    /**
     * Get numberOfTimesViewed
     *
     * @return integer
     */
    public function getNumberOfTimesViewed()
    {
        return $this->numberOfTimesViewed;
    }

    public function increaseViewTimes(){

        $this->numberOfTimesViewed++;
    }

    public function commentCount()
    {
        return $this->comments->count();

    }


    /**
     * Set numberOfComments
     *
     * @param integer $numberOfComments
     * @return Post
     */
    public function setNumberOfComments($numberOfComments)
    {
        $this->numberOfComments = $numberOfComments;

        return $this;
    }

    public function getNumberOfComments()
    {
        return $this->numberOfComments;

    }

    public function increaseNumberOfComments(){

        $this->numberOfComments++;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;


    /**
     * Add comments
     *
     * @param \NEWS\BlogBundle\Entity\Comment $comments
     * @return Post
     */
    public function addComment(\NEWS\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \NEWS\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\NEWS\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('title', new NotBlank());

        $metadata->addPropertyConstraint('text', new NotBlank());
        //$metadata->addPropertyConstraint('text', new MinLength(150));
    }
    /**
     * @var string
     */
    private $picPath;


    /**
     * Set picPath
     *
     * @param string $picPath
     * @return Post
     */
    public function setPicPath($picPath)
    {
        $this->picPath = $picPath;

        return $this;
    }

    /**
     * Get picPath
     *
     * @return string 
     */
    public function getPicPath()
    {
        return $this->picPath;
    }
}
