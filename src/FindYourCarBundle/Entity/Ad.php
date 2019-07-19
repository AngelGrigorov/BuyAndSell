<?php

namespace FindYourCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Ad
 *
 * @ORM\Table(name="ads")
 * @ORM\Entity(repositoryClass="FindYourCarBundle\Repository\AdRepository")
 */
class Ad
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    /**
     * @var string
     */
private $summary;
    /**
     * @var int
     *
     * @ORM\Column(name="authorId", type="integer")
     */
private $authorId;
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="FindYourCarBundle\Entity\User", inversedBy="ad")
     * @ORM\JoinColumn(name="authorId",referencedColumnName="id")
     */

private $author;

    /**
     * Ad constructor.
     * @throws \Exception
     */
    public function __construct()
{
    $this->date = new DateTime('now');
}


    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User $author
     *
     * @return Ad
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }
    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param int $authorId
     *
     * @return Ad
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
        return $this;
    }
    /**
     * @return string
     */
    public function getSummary()
    {
        if($this->summary === null){
            $this->setSummary();
        }
        return $this->summary;
    }

    /**
     * @param string
     */
    public function setSummary()
    {
        $this->summary = substr($this->getContent(), 0, strlen($this->getContent()) / 2). '...';
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Ad
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
     * Set content
     *
     * @param string $content
     *
     * @return Ad
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param DateTime $date
     *
     * @return Ad
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

