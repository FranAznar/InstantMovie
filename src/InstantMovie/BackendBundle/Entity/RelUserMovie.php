<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RelUserMovie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RelUserMovie
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\User")
     */
    private $userId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie")
     */
    private $movieId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication_date", type="datetime")
     */
    private $publicationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=1000)
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="valoration", type="integer", length=2)
     */
    private $valoration;

    /**
     * Set userId
     *
     * @param integer $userId
     * @return RelUserMovie
     */
    public function setUserId(\InstantMovie\BackendBundle\Entity\User$userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set movieId
     *
     * @param integer $movieId
     * @return RelUserMovie
     */
    public function setMovieId(\InstantMovie\BackendBundle\Entity\User$movieId)
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
     * Set publicationDate
     *
     * @param \DateTime $publicationDate
     * @return RelUserMovie
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set valoration
     *
     * @param string $valoration
     * @return RelUserMovie
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
     * @return RelUserMovie
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
