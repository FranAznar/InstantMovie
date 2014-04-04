<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RelMovieActor
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RelMovieActor
{
    /**
     
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie")
     */
    protected $movieId;

    /**
   
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Actor")
     */
    protected $actorId;

    /**
     * @ORM\Id
     * @ORM\Column(name="date_movie")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie")
     */
    protected $dateMovie;

    /**
     * Get id
     *
     * @return integer 
     */
   
    public function setMovieId(\InstantMovie\BackendBundle\Entity\Movie $movieId)
    {
        $this->movieId = $movieId;

        return $this;
    }

    /**
     * Get movieId
     *
     * @return integer 
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set actorId
     *
     * @param integer $actorId
     * @return RelMovieActor
     */
    public function setActorId(\InstantMovie\BackendBundle\Entity\Actor $actorId)
    {
        $this->actorId = $actorId;

        return $this;
    }

    /**
     * Get actorId
     *
     * @return integer 
     */
    public function getActorId()
    {
        return $this->actorId;
    }

   /**
     * Set dateMovie
     *
     * @param \DateTime $dateMovie
     * @return RelMovieActor
     */
    public function setDateMovie(\InstantMovie\BackendBundle\Entity\Movie $dateMovie)
    {
        $this->dateMovie = $dateMovie;

        return $this;
    }

    /**
     * Get dateMovie
     *
     * @return \DateTime 
     */
    public function getDateMovie()
    {
        return $this->dateMovie;
    }
}
