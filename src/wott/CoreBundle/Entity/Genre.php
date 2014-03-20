<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="wott\CoreBundle\Repository\GenreRepository")
 */
class Genre
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="api_id", type="integer")
     */
    private $api_id;

    /**
     * @ORM\ManyToMany(targetEntity="wott\CoreBundle\Entity\Film", mappedBy="genres")
     */
    private $films;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->films = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param  string $name
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set api_id
     *
     * @param  integer $api_id
     * @return Genre
     */
    public function setApiId($api_id)
    {
        $this->api_id = $api_id;

        return $this;
    }

    /**
     * Get api_id
     *
     * @return integer
     */
    public function getApiId()
    {
        return $this->api_id;
    }

    /**
     * Add films
     *
     * @param  \wott\CoreBundle\Entity\Film $films
     * @return Film
     */
    public function addFilm(\wott\CoreBundle\Entity\Film $films)
    {
        $this->films[] = $films;

        return $this;
    }

    /**
     * Remove films
     *
     * @param \wott\CoreBundle\Entity\Film $films
     */
    public function removeFilms(\wott\CoreBundle\Entity\Film $films)
    {
        $this->films->removeElement($films);
    }

    /**
     * Get films
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * Remove films
     *
     * @param \wott\CoreBundle\Entity\Film $films
     */
    public function removeFilm(\wott\CoreBundle\Entity\Film $films)
    {
        $this->films->removeElement($films);
    }
}
