<?php

namespace InstantMovie\BackendBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Director
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Director
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
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    private $lastName;

    /**
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Country")
     */
    private $country;


    /**
     * Get Movies
     *
     * @return Movies
     */
    public function getMovie()
    {
        return $this->movie;
    }

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
     * @return Director
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
     * Set lastName
     *
     * @param string $lastName
     * @return Director
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    public function setCountry(\InstantMovie\BackendBundle\Entity\Country $country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function __toString()
    {
        return $this->name;
    }


    /**
    * Add Movie
    *
    * @param \InstantMovie\BackendBundle\Entity\Director $movie
    * @return Director
    */
    public function addMovie(\InstantMovie\BackendBundle\Entity\Movie $movie)
    {
        $this->movie[] = $movie;
        //$movie->addDirector($this);
        return $this;
    }

    /**
    * Remove Movie
    *
    * @param \InstantMovie\BackendBundle\Entity\Movie $movie
    */
    public function removeMovie(\InstantMovie\BackendBundle\Entity\Movie $movie)
    {
        $this->movie->removeElement($movie);
        $movie->removeDirector($this); 
    }


}
