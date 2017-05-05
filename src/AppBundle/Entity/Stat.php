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
    * @ORM\Column(type="string", length=9999999, unique=false)
    * @Assert\NotBlank()
    */
    private $localisation;

    /**
    * @ORM\Column(type="string", length=9999999, unique=false)
    * @Assert\NotBlank()
    */
    private $consommation;

    /**
    * @ORM\Column(type="string", length=9999999, unique=false)
    * @Assert\NotBlank()
    */
    private $temperature;

    /**
    * @ORM\ManyToOne(targetEntity="Car", inversedBy="stats")
    */
    private $car;

    /**
    * Set type
    *
    * @param string $type
    *
    * @return Maintenance
    */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
    * Get type
    *
    * @return string
    */
    public function getType()
    {
        return $this->type;
    }

    /**
    * Set dateMaintenance
    *
    * @return Maintenance
    */
    public function setDateMaintenance($dateMaintenance)
    {
        $this->dateMaintenance = $dateMaintenance;

        return $this;
    }

    /**
    * Get dateMaintenance
    *
    */
    public function getDateMaintenance()
    {
        return $this->dateMaintenance;
    }

    /**
    * Set kilometres
    *
    * @param integer $kilometres
    *
    * @return Maintenance
    */
    public function setKilometres($kilometres)
    {
        $this->kilometres = $kilometres;

        return $this;
    }

    /**
    * Get kilometres
    *
    * @return integer
    */
    public function getKilometres()
    {
        return $this->kilometres;
    }

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
    * {@inheritdoc}
    */
    public function __toString()
    {
        return $this->getType().' '.$this->getDateMaintenance();
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
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     *
     * @return Stat
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set consommation
     *
     * @param string $consommation
     *
     * @return Stat
     */
    public function setConsommation($consommation)
    {
        $this->consommation = $consommation;

        return $this;
    }

    /**
     * Get consommation
     *
     * @return string
     */
    public function getConsommation()
    {
        return $this->consommation;
    }

    /**
     * Set temperature
     *
     * @param string $temperature
     *
     * @return Stat
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return string
     */
    public function getTemperature()
    {
        return $this->temperature;
    }
}
