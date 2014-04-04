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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="user_id")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\User.php")
     */
    private $userId;

    /**
     * @var integer
     * @ORM\Column(name="movie_id")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie.php")
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
     * @ORM\Column(name="comment", type="string", length="1000")
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="valoration", type="integer")
     */
    private $valoration;




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
     * Set userId
     *
     * @param integer $userId
     * @return RelUserMovie
     */
    public function setUserId($userId)
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
     * @return string 
     */
    public function getValoration()
    {
        return $this->valoration;
    }
}
