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
        $cast = array();
        $director = 'inconnu';

        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository('wottCoreBundle:Film')->find($id);
        $user = $this->getUser();
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

        $fu = $em->getRepository('wottCoreBundle:FilmUser')->findOneBy(array('film'=>$film, 'user'=>$user));
        $filmUser = array(
            'isSeen' => $fu->getIsSeen(),
            'isLike' => $fu->getIsLike(),
            'isWanted' => $fu->getIsWanted()
        );

        return array('film' => $film, 'director' => $director, 'cast' => $cast, 'filmUser' => $filmUser);
    }

}
