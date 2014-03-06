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
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/movie/")
     * @Template()
     */
    public function movieAction()
    {
        return array();
    }

}
