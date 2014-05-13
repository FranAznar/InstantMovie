<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use InstantMovie\BackendBundle\Entity\Movie;

/**
 * Actor
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Actor
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
     * @return Actor
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
     * @return Actor
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

    /**
     * Get Movies
     *
     * @return Movies
     */
    public function getMovie()
    {
        return $this->movie;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
    * Add Movies
    *
    * @param \InstantMovie\BackendBundle\Entity\Movie $movies
    * @return Actor
    */
    public function addMovie(\InstantMovie\BackendBundle\Entity\Movie $movie)
    {
        $this->movie[] = $movie;
        //$movie->addActor($this);
        return $this;
    }

    /**
    * Remove Movies
    *
    * @param \InstantMovie\BackendBundle\Entity\Movie $movies
    */
    public function removeMovie(\InstantMovie\BackendBundle\Entity\Movie $movie)
    {
        $this->movies->removeElement($movie);
        $movie->removeActor($this); 
    }

}
