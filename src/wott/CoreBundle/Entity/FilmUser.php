<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilmUser
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FilmUser
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="wott\CoreBundle\Entity\Film")
     */
    private $film;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="wott\CoreBundle\Entity\FOS_User")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_like", type="datetime")
     */
    private $dateLike;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_seen", type="datetime")
     */
    private $dateSeen;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_like", type="boolean")
     */
    private $isLike;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_seen", type="boolean")
     */
    private $isSeen;


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
     * Set dateLike
     *
     * @param \DateTime $dateLike
     * @return FilmUser
     */
    public function setDateLike($dateLike)
    {
        $this->dateLike = $dateLike;

        return $this;
    }

    /**
     * Get dateLike
     *
     * @return \DateTime 
     */
    public function getDateLike()
    {
        return $this->dateLike;
    }

    /**
     * Set dateSeen
     *
     * @param \DateTime $dateSeen
     * @return FilmUser
     */
    public function setDateSeen($dateSeen)
    {
        $this->dateSeen = $dateSeen;

        return $this;
    }

    /**
     * Get dateSeen
     *
     * @return \DateTime 
     */
    public function getDateSeen()
    {
        return $this->dateSeen;
    }

    /**
     * Set isLike
     *
     * @param boolean $isLike
     * @return FilmUser
     */
    public function setIsLike($isLike)
    {
        $this->isLike = $isLike;

        return $this;
    }

    /**
     * Get isLike
     *
     * @return boolean 
     */
    public function getIsLike()
    {
        return $this->isLike;
    }

    /**
     * Set isSeen
     *
     * @param boolean $isSeen
     * @return FilmUser
     */
    public function setIsSeen($isSeen)
    {
        $this->isSeen = $isSeen;

        return $this;
    }

    /**
     * Get isSeen
     *
     * @return boolean 
     */
    public function getIsSeen()
    {
        return $this->isSeen;
    }
}
