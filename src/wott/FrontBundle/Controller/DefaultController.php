<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\Genre;
use wott\CoreBundle\Entity\People;
use wott\CoreBundle\Entity\FilmPeople;
use wott\CoreBundle\Entity\FilmUser;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("test/")
     * @Template()
     */
    public function testAction()
    {

        $em = $this->getDoctrine()->getManager();
        /*$film=$em->getRepository('wottCoreBundle:Film')->find(1);
        $user=$em->getRepository('wottCoreBundle:User')->find(1);
        $filmUser=new FilmUser();

        $filmUser->setFilm($film);
        $filmUser->setUser($user);
        $filmUser->setNote(5);
        $filmUser->setDateLike();
        $filmUser->setDateSeen();
        $filmUser->setIsLike(1);
        $filmUser->setIsSeen(1);
        $em->persist($filmUser);
        $em->flush();*/
        $filmUser=$em->getRepository('wottCoreBundle:FilmUser')->findAll();


        var_dump($filmUser);

    	return array();

    }

    /**
     * @Route("allocine/")
     * @Template()
     */
    public function allocineAction()
    {
        $allocineApi = $this->container->get('allocine.api');
        $movie = $allocineApi->findMovie('Pulp Fiction');

        return array("movie" => $movie['movie']);
    }

}
