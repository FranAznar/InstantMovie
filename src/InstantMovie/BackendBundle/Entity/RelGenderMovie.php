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
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Gender")
     */
    private $typeId;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="InstantMovie\BackendBundle\Entity\Movie")
     */
    private $movieId;

    /**
     * Set typeId
     *
     * @param integer $typeId
     * @return RelGenderMovie
     */
    public function setTypeId(\InstantMovie\BackendBundle\Entity\Gender $typeId)
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
    public function setMovieId(InstantMovie\BackendBundle\Entity\Movie $movieId)
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
