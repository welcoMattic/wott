<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\FilmPeople;

/**
 * @Route("/films")
 */
class FilmController extends Controller
{
    /**
     * @Route("/showFilm/{id}", name="showFilm", requirements={"id" = "\d+"})
     * @Template()
     */
    public function showFilmAction($id)
    {
        $cast= array();
        $director = 'inconnu';

        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository('wottCoreBundle:Film')->find($id);
        $people = $em->getRepository('wottCoreBundle:People');

        $filmPeople = $em->getRepository('wottCoreBundle:FilmPeople')->getCrewFilm($film);

        foreach ($filmPeople as $people) {
            if ($people->getJob() == 'Director') {
                $director = $people->getPeople()->getName();
            }
            if ($people->getRole()) {
                array_push($cast, $people->getPeople()->getName());
            }
        }

        return array('film' => $film, 'director' => $director, 'cast' => $cast);
    }

}
