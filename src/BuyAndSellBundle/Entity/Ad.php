<?php

namespace BuyAndSellBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ad
 *
 * @ORM\Table(name="ads")
 * @ORM\Entity(repositoryClass="BuyAndSellBundle\Repository\AdRepository")
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
     *@Assert\NotBlank(message=" The title field should not be blank")
     * @Assert\Length(
     *      min = 1,
     *      max = 27,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @Assert\GreaterThan(0,
     *     message="The price should be positive.")
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    /**
     * @var string
     *@Assert\NotBlank(message=" The info field should not be blank")
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Your info must be at least {{ limit }} characters long",
     *      maxMessage = "Your info cannot be longer than {{ limit }} characters")
     * @ORM\Column(name="info", type="string", length=255)
     */
private $info;


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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="BuyAndSellBundle\Entity\User", inversedBy="ad")
     * @ORM\JoinColumn(name="authorId",referencedColumnName="id")
     */

private $author;
    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string")
     */
private $img;
    /**
     * @var string
     *
     * @ORM\Column(name="location",type="string")
     */
private $location;
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
     * Set price
     *
     * @param float $price
     *
     * @return Ad
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
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

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }
    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

}

