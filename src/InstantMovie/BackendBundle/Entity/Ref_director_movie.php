<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ref_director_movie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ref_director_movie
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
     * @var integer
     *
     * @ORM\Column(name="movie_id", type="integer")
     */
    private $movieId;

    /**
     * @var integer
     *
     * @ORM\Column(name="director_id", type="integer")
     */
    private $directorId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_movie", type="datetime")
     */
    private $dateMovie;


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
     * Set movieId
     *
     * @param integer $movieId
     * @return Ref_director_movie
     */
    public function setMovieId($movieId)
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
     * Set directorId
     *
     * @param integer $directorId
     * @return Ref_director_movie
     */
    public function setDirectorId($directorId)
    {
        $this->directorId = $directorId;

        return $this;
    }

    /**
     * Get directorId
     *
     * @return integer 
     */
    public function getDirectorId()
    {
        return $this->directorId;
    }

    /**
     * Set dateMovie
     *
     * @param \DateTime $dateMovie
     * @return Ref_director_movie
     */
    public function setDateMovie($dateMovie)
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
