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
     * @ORM\ManyToOne(targetEntity="wott\CoreBundle\Entity\User")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

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
     * @var boolean
     *
     * @ORM\Column(name="is_wanted", type="boolean")
     */
    private $isWanted;

    public function setFilm(\wott\CoreBundle\Entity\Film $film)
    {
      $this->film = $film;
    }
    public function getFilm()
    {
      return $this->film;
    }

    public function setUser(\wott\CoreBundle\Entity\User $user)
    {
      $this->user = $user;
    }
    public function getUser()
    {
      return $this->user;
    }

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
     * Get note
     *
     * @return integer
     */
    public function getNote()
     {
        return $this->note;
     }

    /**
     * Set note
     *
     * @param integer $note
     * @return FilmUser
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Set dateLike
     *
     * @return FilmUser
     */
    public function setDateLike()
    {
        $this->dateLike = new \Datetime('now');

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
     * @return FilmUser
     */
    public function setDateSeen()
    {
        $this->dateSeen = new \Datetime('now');

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

    /**
     * Set isWanted
     *
     * @param boolean $isWanted
     * @return FilmUser
     */
    public function setIsWanted($isWanted)
    {
        $this->isWanted = $isWanted;

        return $this;
    }

    /**
     * Get isWanted
     *
     * @return boolean 
     */
    public function getIsWanted()
    {
        return $this->isWanted;
    }
}
