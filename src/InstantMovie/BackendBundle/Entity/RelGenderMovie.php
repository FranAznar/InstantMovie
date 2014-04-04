<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RelGenderMovie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RelGenderMovie
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
     * @ORM\Column(name="type_id")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Gender.php")
     */
    private $typeId;

    /**
     * @var integer
     * @ORM\Column(name="movie_id")
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie.php")
     */
    private $movieId;


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
     * Set typeId
     *
     * @param integer $typeId
     * @return RelGenderMovie
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set movieId
     *
     * @param integer $movieId
     * @return RelGenderMovie
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
}
