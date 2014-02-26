<?php
namespace Catalog\FilmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Gedmo\Mapping\Annotation as Gedmo,
    Symfony\Component\Validator\Constraints as Assert,
    Gedmo\Translatable\Translatable;

use Catalog\FilmsBundle\Entity\Trans\FilmTranslation;


/**
 * Films
 *
 * @ORM\Table(name="films")
 * @ORM\Entity(repositoryClass="Catalog\FilmsBundle\Entity\Repository\FilmRepository")
 * @Gedmo\TranslationEntity(class="Catalog\FilmsBundle\Entity\Trans\FilmTranslation")
 */
class Films extends Entity implements Translatable
{
    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Assert\Length(min=3, max=65000)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=true)
     * @Assert\Length(min=3, max=65000)
     * @Assert\NotBlank(groups={"New"})
     */
    private $image;

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
     * @var string
     *
     * @Gedmo\Slug(fields={"name"}, updatable=true, separator="_")
     * @ORM\Column(name="uri", type="text", nullable=true, length=300)
     */
    private $uri;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @Gedmo\Locale
     */
    private $locale;

    /**
     * @ORM\OneToMany(
     *   targetEntity="Catalog\FilmsBundle\Entity\Trans\FilmTranslation",
     *   mappedBy="object",
     *   cascade={"persist", "remove"}
     * )
     */
    private $translations;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
        $this->genre = new \Doctrine\Common\Collections\ArrayCollection();

        $this->translations = new ArrayCollection();
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    public function addTranslation(FilmTranslation $t)
    {
        if (!$this->translations->contains($t)) {
            $this->translations[] = $t;
            $t->setObject($this);
        }
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
     * @param string $image
     * @return Films
     */
    public function setImage($image)
    {
        if('' != $image)
            $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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

    /**
     * @param string $uri
     * @return Films
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }
    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param \Catalog\FilmsBundle\Entity\datetime $created
     * @return Films
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @param \Catalog\FilmsBundle\Entity\datetime $updated
     * @return Films
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }


    /**
     * @return \Catalog\FilmsBundle\Entity\datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \Catalog\FilmsBundle\Entity\datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}