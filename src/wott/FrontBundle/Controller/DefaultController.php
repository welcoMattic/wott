<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\Genre;

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

    	$film = $this->getDoctrine()->getRepository('wottCoreBundle:Film')->find(1);
    	$genre = $this->getDoctrine()->getRepository('wottCoreBundle:Genre')->find(1);

    	var_dump($film);
    	echo "<hr>";
    	var_dump($genre);

    	


    	return array();



    }
}
