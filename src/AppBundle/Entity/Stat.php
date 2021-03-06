<?php
// src/AppBundle/Entity/Stat.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\Common\IdTrait;

/**
* @ORM\Entity
*/
class Stat
{
    use idTrait;

    /**
    * @ORM\Column(type="date", length=255, unique=false)
    * @Assert\NotBlank()
    * @Assert\Date()
    */
    private $date;

    /**
    * @ORM\Column(type="guid")
    * @ORM\GeneratedValue(strategy="UUID")
    */
    private $uuid;

    /**
    * @ORM\Column(type="string", length=9999999, unique=false)
    * @Assert\NotBlank()
    */
    private $value;

    /**
    * @ORM\ManyToOne(targetEntity="Car", inversedBy="stats")
    */
    private $car;

    /**
    * Set car
    *
    * @param \AppBundle\Entity\Car $car
    *
    * @return Maintenance
    */
    public function setCar(\AppBundle\Entity\Car $car = null)
    {
        $this->car = $car;

        return $this;
    }

    /**
    * Get car
    *
    * @return \AppBundle\Entity\Car
    */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Stat
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Set uuid
     *
     * @param guid $uuid
     *
     * @return User
     */
    public function setUuid()
    {
        $this->uuid = uniqid();

        return $this;
    }

    /**
     * Get uuid
     *
     * @return guid
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
    * {@inheritdoc}
    */
    public function __toString()
    {
        return $this->getTemperature();
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Stat
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
