<?php
// src/AppBundle/Entity/Maintenance.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\Common\IdTrait;

/**
* @ORM\Entity
*/
class Maintenance
{
    use idTrait;

    /**
    * @ORM\Column(type="string", length=255, unique=false)
    * @Assert\NotBlank()
    */
    private $type;

    /**
    * @ORM\Column(type="date", length=255, unique=false)
    * @Assert\NotBlank()
    * @Assert\Date()
    */
    private $dateMaintenance;

    /**
    * @ORM\Column(type="integer", length=255, unique=false)
    */
    private $kilometres;

    /**
    * @ORM\ManyToOne(targetEntity="Car", inversedBy="maintenances")
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
}
