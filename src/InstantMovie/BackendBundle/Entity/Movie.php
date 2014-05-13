<?php

namespace InstantMovie\BackendBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Movie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=100)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var \Date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Country")
     */
    private $country;

    /*
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Gender")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="synapses", type="string", length=1000)
     */
    private $synapses;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     */
    private $image;


   /**
    * @ORM\ManyToMany(targetEntity="Actor")
    * @ORM\JoinTable(name="RelMovieActor")
    *   joinColumns={@JoinColumn(name="movie_id", referencedColumnName="id")},
    *   inverseJoinColumns={@JoinColumn(name="actor_id", referencedColumnName="id
    *   )
    **/
    private $actors;

   /**
    * @ORM\ManyToMany(targetEntity="Director")
    * @ORM\JoinTable(name="RelMovieDirector")
    *   joinColumns={@JoinColumn(name="movie_id", referencedColumnName="id")},
    *   inverseJoinColumns={@JoinColumn(name="director_id", referencedColumnName="id
    *   )
    **/
    private $director;

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
     * Set url
     *
     * @param string $url
     * @return Movie
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Movie
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set date
     *
     * @param \Date $date
     * @return Movie
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \Date 
     */
    public function getDate()
    {
        return $this->date;
    }

   /**
     * Set country
     *
     * @param string $country
     * @return Movie
     */
    public function setCountry(\InstantMovie\BackendBundle\Entity\Country $country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return country
     */
    public function getCountry()
    {
        return $this->country;
    }

   /**
     * Set synapses
     *
     * @param string $synapses
     * @return Movie
     */
    public function setSynapses($synapses)
    {
        $this->synapses = $synapses;

        return $this;
    }

    /**
     * Get Actors
     *
     * @return actors
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * Get Directors
     *
     * @return directors
     */
    public function getDirector()
    {
        return $this->director;
    }


    /**
     * Get synapses
     *
     * @return string
     */
    public function getSynapses()
    {
        return $this->synapses;
    }

   /**
     * Set type
     *
     * @param string $type
     * @return Movie
     */
    public function setType(\InstantMovie\BackendBundle\Entity\Gender $type)
    {
        $this->type = $type;
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



    public function __toString()
    {
        return $this->title;
    }

    
   /**
    * Add Actor
    *
    * @param \InstantMovie\BackendBundle\Entity\Actor $actors
    * @return Movie
    */
    public function addActor(\InstantMovie\BackendBundle\Entity\Actor $actor)
    {
        $this->actors[] = $actor;
        //$actor->addMovie($this);
        return $this;
    }

    /**
    * Remove Actor
    *
    * @param \InstantMovie\BackendBundle\Entity\Actor $actor
    */
    public function removeActor(\InstantMovie\BackendBundle\Entity\Actor $actor)
    {
        $this->actors->removeElement($actor);
       // $actor->removeMovie($this);
    }


    /**
    * Add Director
    *
    * @param \InstantMovie\BackendBundle\Entity\Director $director
    * @return Movie
    */
    public function addDirector(\InstantMovie\BackendBundle\Entity\Director $director)
    {
        $this->director[] = $director;
        //$director->addMovie($this);

        return $this;
    }

    /**
    * Remove Director
    *
    * @param \InstantMovie\BackendBundle\Entity\Director $director
    */
    public function removeDirector(\InstantMovie\BackendBundle\Entity\Director $director)
    {
        $this->director->removeElement($director);
        //$director->removeMovie($this);
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->director = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
