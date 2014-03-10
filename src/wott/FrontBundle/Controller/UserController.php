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
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/filmuser", name="filmUser")
     */
    public function filmUserAction(Request $request)
    {
        $idFilm = $request->request->get('idFilm');
        $action = $request->request->get('action');
        $idUser = $this->container->get('security.context')->getToken()->getUser()->getId();

        $setter = 'setIs'.$action;
        $getter = 'getIs'.$action;
        $date = 'setDate'.$action;

        $em=$this->getDoctrine()->getManager();

        $film=$em->getRepository('wottCoreBundle:Film')->find($idFilm);
        $user=$em->getRepository('wottCoreBundle:User')->find($idUser);

        $filmUser = $em->getRepository('wottCoreBundle:FilmUser')->findOneBy(array('film'=>$film, 'user'=>$user));

        if (empty($filmUser)) {
            $filmUser= new FilmUser();
            $filmUser->setUser($user);
            $filmUser->setFilm($film);
            $filmUser->$setter(true);
            $filmUser->$date();

            $em->persist($filmUser);
        } else {
            $$getter=$filmUser->$getter();

            if (!$$getter) {

                $filmUser->$setter(true);
                $filmUser->$date();
            } else {

                $filmUser->$setter(false);
                $filmUser->$date();
            }
        }

        $em->flush();
        $$getter = $filmUser->$getter();

        return new Response(var_dump($$getter));
    }

    /**
     * @Route("/suggest", name="suggest")
     * @Template()
     */
    public function suggestAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $likedFilms = $em->getRepository('wottCoreBundle:FilmUser')->getLikesByUser($user);
        $likedGenres = array();
        $tmpFilms = array();
        foreach($likedFilms as $likedFilm) {
            foreach($likedFilm->getFilm()->getGenres() as $genre) {
                $tmpFilms[] = $em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity($genre, 10);
                // [TODO] get isSeen films and pop them
            }
        }
        return array('tmpFilms' => $tmpFilms);
    }

}
