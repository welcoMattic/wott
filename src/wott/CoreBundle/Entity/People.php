<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * People
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="wott\CoreBundle\Repository\PeopleRepository")
 */
class People
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
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=255, nullable=true)
     */
    private $nationality;

    /**
     * @var text
     *
     * @ORM\Column(name="biography", type="text", nullable=true)
     */
    private $biography;

    /**
     * @var date
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var date
     *
     * @ORM\Column(name="deathday", type="date", nullable=true)
     */
    private $deathday;

    /**
     * @var string
     *
     * @ORM\Column(name="url_profile_image", type="string", length=255, nullable=true)
     */
    private $url_profile_image;

    /**
     * @var integer
     *
     * @ORM\Column(name="api_id", type="string", length=255)
     */
    private $api_id;

    /**
     * @ORM\OneToMany(targetEntity="wott\CoreBundle\Entity\FilmPeople", mappedBy="people", cascade={"persist", "remove"})
     */
    private $filmPeople;

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
     * @param string $name
     * @return People
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
     * Set nationality
     *
     * @param string $nationality
     * @return People
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set age
     *
     * @param date $birthday
     * @return People
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return date
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set url_profile_image
     *
     * @param string $url_profile_image
     * @return People
     */
    public function setUrlProfileImage($url_profile_image)
    {
        $this->url_profile_image = $url_profile_image;

        return $this;
    }

    /**
     * Get url_profile_image
     *
     * @return string
     */
    public function getUrlProfileImage()
    {
        return $this->url_profile_image;
    }

    /**
     * Set api_id
     *
     * @param string $apiId
     * @return People
     */
    public function setApiId($api_id)
    {
        $this->api_id = $api_id;

        return $this;
    }

    /**
     * Get api_id
     *
     * @return string
     */
    public function getApiId()
    {
        return $this->api_id;
    }

    /**
     * Set biography
     *
     * @param string $biography
     * @return People
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * Get biography
     *
     * @return string
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * Set deathday
     *
     * @param \DateTime $deathday
     * @return People
     */
    public function setDeathday($deathday)
    {
        $this->deathday = $deathday;

        return $this;
    }

    /**
     * Get deathday
     *
     * @return \DateTime
     */
    public function getDeathday()
    {
        return $this->deathday;
    }
}
