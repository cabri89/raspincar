<?php

namespace AppBundle\Entity\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class IdTrait
 */
trait IdTrait
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
