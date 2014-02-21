<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\Genre;
use wott\CoreBundle\Entity\People;
use wott\CoreBundle\Entity\FilmPeople;

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
        $film=$em->getRepository('wottCoreBundle:Film')->find(1);
        $people=$em->getRepository('wottCoreBundle:People')->find(1);
        /*$filmPeople=new FilmPeople();

        $filmPeople->setFilm($film);
        $filmPeople->setPeople($people);
        $filmPeople->setJob('Director');
        $filmPeople->setRole('batman');
        $em->persist($filmPeople);
        $em->flush();*/
        $filmPeople=$em->getRepository('wottCoreBundle:FilmPeople')->findAll();


        var_dump($filmPeople);

    	return array();

    }
}
