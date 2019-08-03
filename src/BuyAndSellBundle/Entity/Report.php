<?php

namespace BuyAndSellBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Report
 *
 * @ORM\Table(name="reports")
 * @ORM\Entity(repositoryClass="BuyAndSellBundle\Repository\ReportRepository")
 */
class Report
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
     * @var int
     *
     * @ORM\Column(name="authorId", type="integer")
     */
    private $authorId;

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="BuyAndSellBundle\Entity\User", inversedBy="ad")
     * @ORM\JoinColumn(name="authorId",referencedColumnName="id")
     */

    private $author;
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
     * @return Report
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
     * @return Report
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
        return $this;
    }
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Report
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Report
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
