<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\FilmUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("movie/")
     * @Template()
     */
    public function movieAction()
    {
        return array();
    }

    /**
     * @Route("like/", name="like")
     */
    public function likeAction(Request $request)
    {

        $idFilm=$request->request->get('idFilm');
        $action=$request->request->get('action');
        $idUser=$this->container->get('security.context')->getToken()->getUser()->getId();

        $setter = 'setIs'.$action;
        $getter = 'getIs'.$action;
        $date = 'setDate'.$action;

        $em=$this->getDoctrine()->getManager();

        $film=$em->getRepository('wottCoreBundle:Film')->find($idFilm);
        $user=$em->getRepository('wottCoreBundle:User')->find($idUser);

        $filmUser=$em->getRepository('wottCoreBundle:FilmUser')->findOneBy(array('film'=>$film, 'user'=>$user));

        if (empty($filmUser)) {
            $filmUser= new FilmUser();
            $filmUser->setUser($user);
            $filmUser->setFilm($film);
            $filmUser->$setter(true);
            $filmUser->$date();

            $em->persist($filmUser);
        } else {
            $$getter=$filmUser->$getter();

            if ($$getter==false) {

                $filmUser->$setter(true);
                $filmUser->$date();
            } else {

                $filmUser->$setter(false);
                $filmUser->$date();
            }
        }

        $em->flush();
        $$getter=$filmUser->$getter();

        return new Response(var_dump($$getter));
    }

}
