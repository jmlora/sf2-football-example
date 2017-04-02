<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 */
class Player
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     * @return Player
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @var \AppBundle\Entity\Club
     */
    private $product;


    /**
     * Set product
     *
     * @param \AppBundle\Entity\Club $product
     * @return Player
     */
    public function setProduct(\AppBundle\Entity\Club $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Club 
     */
    public function getProduct()
    {
        return $this->product;
    }
    /**
     * @var \AppBundle\Entity\Club
     */
    private $club;


    /**
     * Set club
     *
     * @param \AppBundle\Entity\Club $club
     * @return Player
     */
    public function setClub(\AppBundle\Entity\Club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \AppBundle\Entity\Club 
     */
    public function getClub()
    {
        return $this->club;
    }
}
