<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilmPeople
 *
 * @ORM\Table(name="film_people")
 * @ORM\Entity
 */
class FilmPeople
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="wott\CoreBundle\Entity\Film", inversedBy="filmPeople", cascade={"persist", "remove"})
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="wott\CoreBundle\Entity\People", inversedBy="filmPeople", cascade={"persist", "remove"})
     */
    private $people;

    /**
     * @var string
     *
     * @ORM\Column(name="job", type="string", length=255, nullable=true)
     */
    private $job;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     */
    private $role;

    /**
     * Set film
     *
     * @param object Film
     * @return FilmPeople
     */
    public function setFilm(\wott\CoreBundle\Entity\Film $film)
    {
      $this->film = $film;

      return $this;
    }

    /**
     * Get Film
     *
     * @param object Film
     * @return Film
     */
    public function getFilm()
    {
      return $this->film;
    }

    /**
     * Set people
     *
     * @param object People
     * @return People
     */
    public function setPeople(\wott\CoreBundle\Entity\People $people)
    {
      $this->people = $people;

      return $this;
    }

    /**
     * Get Film
     *
     * @param object People
     * @return People
     */
    public function getPeople()
    {
      return $people->people;
    }

    /**
     * Set job
     *
     * @param  string     $job
     * @return FilmPeople
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set role
     *
     * @param  string     $role
     * @return FilmPeople
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
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
}
