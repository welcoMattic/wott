<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\FilmUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository('wottCoreBundle:Film')->find($id);

        return array('film' => $film);
    }

}