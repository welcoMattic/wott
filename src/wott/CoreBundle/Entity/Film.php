<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="wott\CoreBundle\Entity\FilmRepository")
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
    private $date_cinema;

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
     * @ORM\Column(name="nationalities", type="json_array", nullable=true)
     */
    private $nationalities;

    /**
     * @var integer
     *
     * @ORM\Column(name="runtime", type="integer")
     *
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

    public function __construct()
    {
      $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
      * @param wott\CoreBundle\Entity\Genre $genres
      */
    public function addGenre(\wott\CoreBundle\Entity\Genre $genre)
    {
      $this->genres[] = $genre;
    }
  
    /**
      * @param wott\CoreBundle\Entity\Genre $genres
      */
    public function removeGenre(\wott\CoreBundle\Entity\Genre $genre)
    {
      $this->genres->removeElement($genre);
    }
  
    /**
      * @return Doctrine\Common\Collections\Collection
      */
    public function getGenres() 
    {
      return $this->genres;
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
     * Set title
     *
     * @param string $title
     * @return Film
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
     * Set original_title
     *
     * @param string $original_title
     * @return Film
     */
    public function setOriginalTitle($original_title)
    {
        $this->originalTitle = $original_title;

        return $this;
    }

    /**
     * Get original_title
     *
     * @return string 
     */
    public function getOriginalTitle()
    {
        return $this->original_title;
    }

    /**
     * Set dateDvd
     *
     * @param \DateTime $date_dvd
     * @return Film
     */
    public function setDateDvd($date_dvd)
    {
        $this->date_dvd = $date_dvd;

        return $this;
    }

    /**
     * Get date_dvd
     *
     * @return \DateTime 
     */
    public function getDateDvd()
    {
        return $this->date_dvd;
    }

    /**
     * Set date_cinema
     *
     * @param \DateTime $date_cinema
     * @return Film
     */
    public function setDateCinema($date_cinema)
    {
        $this->date_cinema = $date_cinema;

        return $this;
    }

    /**
     * Get date_cinema
     *
     * @return \DateTime 
     */
    public function getDateCinema()
    {
        return $this->date_cinema;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     * @return Film
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
     * @return Film
     */
    public function setUrlTrailer($url_trailer)
    {
        $this->url_trailer = $url_trailer;

        return $this;
    }

    /**
     * Get urlTrailer
     *
     * @return string 
     */
    public function getUrlTrailer()
    {
        return $this->url_trailer;
    }

    /**
     * Set nationalities
     *
     * @param array $nationalities
     * @return Film
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
     * @return Film
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
     * @return Film
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
     * @return Film
     */
    public function setUrlPoster($url_poster)
    {
        $this->url_poster = $url_poster;

        return $this;
    }

    /**
     * Get urlPoster
     *
     * @return string 
     */
    public function getUrlPoster()
    {
        return $this->url_poster;
    }
}
