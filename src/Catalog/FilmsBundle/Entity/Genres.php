<?php

namespace Catalog\FilmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genres
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity
 */
class Genres extends Entity
{
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Films", mappedBy="genre")
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
     * Add film
     *
     * @param \Catalog\FilmsBundle\Entity\Films $film
     * @return Genres
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