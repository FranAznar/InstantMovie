<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ref_movie_actor
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ref_movie_actor
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
     * @ORM\Column(name="actor_id", type="integer")
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
     * @return Ref_movie_actor
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
     * @return Ref_movie_actor
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
     * @return Ref_movie_actor
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
     * @return Ref_movie_actor
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
}
