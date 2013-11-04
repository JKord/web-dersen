<?php
namespace Catalog\FilmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Films
 *
 * @ORM\Table(name="films")
 * @ORM\Entity
 */
class Films extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Actors", inversedBy="film")
     * @ORM\JoinTable(name="films_actors",
     *   joinColumns={
     *     @ORM\JoinColumn(name="film_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="actor_id", referencedColumnName="id")
     *   }
     * )
     */
    private $actor;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Categories", inversedBy="film")
     * @ORM\JoinTable(name="films_categories",
     *   joinColumns={
     *     @ORM\JoinColumn(name="film_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *   }
     * )
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Genres", inversedBy="film")
     * @ORM\JoinTable(name="films_genres",
     *   joinColumns={
     *     @ORM\JoinColumn(name="film_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="genre_id", referencedColumnName="id")
     *   }
     * )
     */
    private $genre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->genre = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Films
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add actor
     *
     * @param \Catalog\FilmsBundle\Entity\Actors $actor
     * @return Films
     */
    public function addActor(\Catalog\FilmsBundle\Entity\Actors $actor)
    {
        $this->actor[] = $actor;
    
        return $this;
    }

    /**
     * Remove actor
     *
     * @param \Catalog\FilmsBundle\Entity\Actors $actor
     */
    public function removeActor(\Catalog\FilmsBundle\Entity\Actors $actor)
    {
        $this->actor->removeElement($actor);
    }

    /**
     * Get actor
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * Add category
     *
     * @param \Catalog\FilmsBundle\Entity\Categories $category
     * @return Films
     */
    public function addCategory(\Catalog\FilmsBundle\Entity\Categories $category)
    {
        $this->category[] = $category;
    
        return $this;
    }

    /**
     * Remove category
     *
     * @param \Catalog\FilmsBundle\Entity\Categories $category
     */
    public function removeCategory(\Catalog\FilmsBundle\Entity\Categories $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add genre
     *
     * @param \Catalog\FilmsBundle\Entity\Genres $genre
     * @return Films
     */
    public function addGenre(\Catalog\FilmsBundle\Entity\Genres $genre)
    {
        $this->genre[] = $genre;
    
        return $this;
    }

    /**
     * Remove genre
     *
     * @param \Catalog\FilmsBundle\Entity\Genres $genre
     */
    public function removeGenre(\Catalog\FilmsBundle\Entity\Genres $genre)
    {
        $this->genre->removeElement($genre);
    }

    /**
     * Get genre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGenre()
    {
        return $this->genre;
    }
}