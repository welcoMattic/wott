<?php

namespace wott\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FilmPeople
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FilmPeople
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="wott\CoreBundle\Entity\Film", inversedBy="filmPeople")
     */
    private $film;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="wott\CoreBundle\Entity\People", inversedBy="filmPeople")
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
     * @param object $Film
     * @return Film
     */
    public function getFilm()
    {
      return $this->film;
    }


    public function setPeople(\wott\CoreBundle\Entity\People $people)
    {
      $this->people = $people;
    }
    public function getPeople()
    {
      return $people->people;
    }


    /**
     * Set job
     *
     * @param string $job
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
     * @param string $role
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
}
