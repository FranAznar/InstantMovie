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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="movie_id")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie.php")
     */
    private $movieId;

    /**
     * @var integer
     * @ORM\Column(name="actor_id")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Actor.php")
     */
    private $actorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="valoration", type="integer")
     */
    private $valoration;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=1000)
     */
    private $comment;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_movie")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie.php")
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
     * @return RelMovieActor
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
     * Set actorId
     *
     * @param integer $actorId
     * @return RelMovieActor
     */
    public function setActorId($actorId)
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
     * Set valoration
     *
     * @param integer $valoration
     * @return RelMovieActor
     */
    public function setValoration($valoration)
    {
        $this->valoration = $valoration;

        return $this;
    }

    /**
     * Get valoration
     *
     * @return integer 
     */
    public function getValoration()
    {
        return $this->valoration;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return RelMovieActor
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }


   /**
     * Set dateMovie
     *
     * @param \DateTime $dateMovie
     * @return RelMovieActor
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
