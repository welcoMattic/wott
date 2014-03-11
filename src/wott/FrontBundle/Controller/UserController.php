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
        $likedFilmsByUser = $em->getRepository('wottCoreBundle:FilmUser')->getLikesByUser($user);
        $films = array();
        $seenFilms = array();

        foreach($likedFilmsByUser as $likedFilmByUser) {
            foreach($likedFilmByUser->getFilm()->getGenres() as $genre) {
                $filmsByLikedGenres = $em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity(10, $genre);
                $seenFilmsUser = $em->getRepository('wottCoreBundle:FilmUser')->getIsSeenFilms($user);
                foreach($seenFilmsUser as $seenFilmUser) {
                    $seenFilms[] = $seenFilmUser->getFilm();
                }
                foreach($filmsByLikedGenres as $filmsByLikedGenre) {
                    if(!in_array($filmsByLikedGenre, $seenFilms) && !in_array($filmsByLikedGenre, $films)) {
                        $films[] = $filmsByLikedGenre;
                    }
                }
            }
        }

        return array('films' => $films);
    }

}
