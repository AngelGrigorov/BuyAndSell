<?php

namespace BuyAndSellBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="BuyAndSellBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @Assert\NotBlank(message=" Въведете имейл.")
     * @Assert\Email(
     *     message = "'{{ value }}' е невалиден имейл.",
     *     checkMX = false
     * )
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @Assert\NotBlank(message=" Трябва да въведете парола.")
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     *      minMessage = "Паролата трябва да бъде поне {{ limit }} символа",
     *      maxMessage = "Паролата не трябва да бъде повече от {{ limit }} символа")
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BuyAndSellBundle\Entity\Ad", mappedBy="author")
     */
    private $ads;

    /**
     * @return ArrayCollection
     */


    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * @Assert\NotBlank(message="Полето за име не трябва да е празно.")
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="BuyAndSellBundle\Entity\Role")
     * @JoinTable(name="users_roles",
     *     joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="role_id", referencedColumnName="id")}
     *     )
     */
    private $roles;

    /**
     * @Assert\NotBlank(message="Въведете номер за контакт с вас")
     * @Assert\Length(
     *      min = 10,
     *      max = 12,
     *      minMessage = "Вашият номер трябва да бъде поне {{ limit }} цифри",
     *      maxMessage = "Вашият номер не трябва да бъде повече от {{ limit }} цифри")
     * @Assert\GreaterThan(0,
     *     message="Моля въведете реален номер.")
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=12)
     */
    private $number;

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }


   public function __construct()
   {
       $this->ads = new ArrayCollection();
       $this->roles = new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $stringRoles = [];
        foreach ($this->roles as $role){
            /** @var Role $role */
            $stringRoles[] = $role->getRole();
        }
        return $stringRoles;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @param \BuyAndSellBundle\Entity\Ad $ad
     * @return User
     */
    public function addPost(Ad $ad)
    {
        $this->ads[] = $ad;
        return $this;
    }

    /**
     * @param Role $role
     *
     * @return User
     */
    public function addRole(Role $role)
    {
$this->roles[] = $role;
return $this;
    }

    /**
     * @param Ad $ad
     *
     * @return bool
     */
    public function isAuthor(Ad $ad)
    {
return $ad->getAuthorId() == $this->getId();
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
return in_array('ROLE_ADMIN', $this->getRoles());
    }

}

