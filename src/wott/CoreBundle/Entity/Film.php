<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="wott\CoreBundle\Repository\FilmRepository")
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
     * @ORM\Column(name="release_date", type="datetime")
     */
    private $release_date;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text")
     */
    private $synopsis;

    /**
     * @var string
     *
     * @ORM\Column(name="urlTrailer", type="text", nullable=true)
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

    /**
     * @var integer
     *
     * @ORM\Column(name="api_id", type="integer")
     *
     */
    private $api_id;

    /**
     * @ORM\ManyToMany(targetEntity="wott\CoreBundle\Entity\Genre", inversedBy="films")
     */
    private $genres;

    /**
     * @ORM\OneToMany(targetEntity="wott\CoreBundle\Entity\FilmPeople", mappedBy="film")
     */
    private $filmPeople;

    public function __construct()
    {
      $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  string $title
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
     * @param  string $original_title
     * @return Film
     */
    public function setOriginalTitle($original_title)
    {
        $this->original_title = $original_title;

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
     * Set release_date
     *
     * @param  \DateTime $release_date
     * @return Film
     */
    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }

    /**
     * Get release_date
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * Set synopsis
     *
     * @param  string $synopsis
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
     * @param  string $urlTrailer
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
     * @param  array $nationalities
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
     * @param  integer $runtime
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
     * @param  float $popularity
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
     * @param  string $urlPoster
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

    /**
     * Set api_id
     *
     * @param  integer $apiId
     * @return Film
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
     * Set date_release
     *
     * @param  \DateTime $dateRelease
     * @return Film
     */
    public function setDateRelease($dateRelease)
    {
        $this->date_release = $dateRelease;

        return $this;
    }

    /**
     * Get date_release
     *
     * @return \DateTime
     */
    public function getDateRelease()
    {
        return $this->date_release;
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
     * Add filmPeople
     *
     * @param  \wott\CoreBundle\Entity\FilmPeople $filmPeople
     * @return Film
     */
    public function addFilmPeople(\wott\CoreBundle\Entity\FilmPeople $filmPeople)
    {
        $this->filmPeople[] = $filmPeople;

        return $this;
    }

    /**
     * Remove filmPeople
     *
     * @param \wott\CoreBundle\Entity\FilmPeople $filmPeople
     */
    public function removeFilmPeople(\wott\CoreBundle\Entity\FilmPeople $filmPeople)
    {
        $this->filmPeople->removeElement($filmPeople);
    }

    /**
     * Get filmPeople
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilmPeople()
    {
        return $this->filmPeople;
    }
}
