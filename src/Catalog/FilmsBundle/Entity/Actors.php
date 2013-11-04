<?php

namespace Catalog\FilmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actors
 *
 * @ORM\Table(name="actors")
 * @ORM\Entity
 */
class Actors extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=false)
     */
    private $birthday;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Films", mappedBy="actor")
     */
    private $film;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->film = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Actors
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Add film
     *
     * @param \Catalog\FilmsBundle\Entity\Films $film
     * @return Actors
     */
    public function addFilm(\Catalog\FilmsBundle\Entity\Films $film)
    {
        $this->film[] = $film;
    
        return $this;
    }

    /**
     * Remove film
     *
     * @param \Catalog\FilmsBundle\Entity\Films $film
     */
    public function removeFilm(\Catalog\FilmsBundle\Entity\Films $film)
    {
        $this->film->removeElement($film);
    }

    /**
     * Get film
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilm()
    {
        return $this->film;
    }
}