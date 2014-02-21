<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Films
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="wott\CoreBundle\Entity\FilmsRepository")
 */
class Film
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="original_title", type="string", length=255)
     */
    private $original_title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_dvd", type="datetime")
     */
    private $date_dvd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_cinema", type="datetime")
     */
    private $dateCinema;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text")
     */
    private $synopsis;

    /**
     * @var string
     *
     * @ORM\Column(name="urlTrailer", type="text")
     */
    private $url_trailer;

    /**
     * @var array
     *
     * @ORM\Column(name="nationalities", type="json_array")
     */
    private $nationalities;

    /**
     * @var integer
     *
     * @ORM\Column(name="runtime", type="integer")
     */
    private $runtime;

    /**
     * @var float
     *
     * @ORM\Column(name="popularity", type="float")
     */
    private $popularity;

    /**
     * @var string
     *
     * @ORM\Column(name="url_poster", type="text")
     */
    private $url_poster;

    /*
     *
     * @ORM\ManyToMany(targetEntity="Sdz\BlogBundle\Entity\Genre", cascade={"persist"})
     */
    private $genres;




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
     * Set title
     *
     * @param string $title
     * @return Films
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set originalTitle
     *
     * @param string $originalTitle
     * @return Films
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    /**
     * Get originalTitle
     *
     * @return string 
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * Set dateDvd
     *
     * @param \DateTime $dateDvd
     * @return Films
     */
    public function setDateDvd($dateDvd)
    {
        $this->dateDvd = $dateDvd;

        return $this;
    }

    /**
     * Get dateDvd
     *
     * @return \DateTime 
     */
    public function getDateDvd()
    {
        return $this->dateDvd;
    }

    /**
     * Set dateCinema
     *
     * @param \DateTime $dateCinema
     * @return Films
     */
    public function setDateCinema($dateCinema)
    {
        $this->dateCinema = $dateCinema;

        return $this;
    }

    /**
     * Get dateCinema
     *
     * @return \DateTime 
     */
    public function getDateCinema()
    {
        return $this->dateCinema;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     * @return Films
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string 
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set urlTrailer
     *
     * @param string $urlTrailer
     * @return Films
     */
    public function setUrlTrailer($urlTrailer)
    {
        $this->urlTrailer = $urlTrailer;

        return $this;
    }

    /**
     * Get urlTrailer
     *
     * @return string 
     */
    public function getUrlTrailer()
    {
        return $this->urlTrailer;
    }

    /**
     * Set nationalities
     *
     * @param array $nationalities
     * @return Films
     */
    public function setNationalities($nationalities)
    {
        $this->nationalities = $nationalities;

        return $this;
    }

    /**
     * Get nationalities
     *
     * @return array 
     */
    public function getNationalities()
    {
        return $this->nationalities;
    }

    /**
     * Set runtime
     *
     * @param integer $runtime
     * @return Films
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;

        return $this;
    }

    /**
     * Get runtime
     *
     * @return integer 
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * Set popularity
     *
     * @param float $popularity
     * @return Films
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

        return $this;
    }

    /**
     * Get popularity
     *
     * @return float 
     */
    public function getPopularity()
    {
        return $this->popularity;
    }

    /**
     * Set urlPoster
     *
     * @param string $urlPoster
     * @return Films
     */
    public function setUrlPoster($urlPoster)
    {
        $this->urlPoster = $urlPoster;

        return $this;
    }

    /**
     * Get urlPoster
     *
     * @return string 
     */
    public function getUrlPoster()
    {
        return $this->urlPoster;
    }
}