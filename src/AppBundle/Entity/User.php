<?php
// src/AppBundle/Entity/User.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\Common\IdTrait;

/**
* @ORM\Entity
* @UniqueEntity(fields="email", message="Email already taken")
* @UniqueEntity(fields="username", message="Username already taken")
*/
class User implements UserInterface
{
    use idTrait;

    /**
    * @ORM\Column(type="string", length=255, unique=true)
    * @Assert\NotBlank()
    * @Assert\Email()
    */
    private $email;

    /**
    * @ORM\Column(type="string", length=255, unique=true)
    * @Assert\NotBlank()
    */
    private $username;

    /**
    * @ORM\Column(type="string", length=10, unique=true)
    * @Assert\NotBlank()
    */
    private $phone;

    /**
    * @ORM\Column(type="string", length=255, unique=false)
    */
    private $roles;

    /**
    * @ORM\Column(name="is_active", type="boolean")
    */
    private $isActive;

    /**
    * @Assert\Length(max=4096)
    */
    private $plainPassword;

    /**
    * The below length depends on the "algorithm" you use for encoding
    * the password, but this works well with bcrypt.
    *
    * @ORM\Column(type="string", length=64)
    */
    private $password;

    /**
    * @ORM\OneToMany(targetEntity="Car", mappedBy="user")
    */
    private $cars;


    /**
    * Constructor
    */
    public function __construct()
    {
        $this->cars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    // other properties and methods

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRoles()
    {
        return [$this->roles];
    }

    public function setRole($role)
    {
        $this->roles = $role;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getIsActive()
    {
        return $this->isActive;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function eraseCredentials()
    {
    }

    /**
    * Add car
    *
    * @param \AppBundle\Entity\Car $car
    *
    * @return User
    */
    public function addCar(\AppBundle\Entity\Car $car)
    {
        $this->cars[] = $car;

        return $this;
    }

    /**
    * Remove car
    *
    * @param \AppBundle\Entity\Car $car
    */
    public function removeCar(\AppBundle\Entity\Car $car)
    {
        $this->cars->removeElement($car);
    }

    /**
    * Get cars
    *
    * @return \Doctrine\Common\Collections\Collection
    */
    public function getCars()
    {
        return $this->cars;
    }

    /**
    * {@inheritdoc}
    */
    public function __toString()
    {
        return $this->getUsername();
    }
}
