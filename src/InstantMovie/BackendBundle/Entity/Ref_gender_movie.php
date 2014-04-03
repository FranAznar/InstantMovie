<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ref_gender_movie
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ref_gender_movie
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
     * @ORM\Column(name="type_id", type="integer")
     */
    private $typeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="movie_id", type="integer")
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
     * @return Ref_gender_movie
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
     * @return Ref_gender_movie
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
