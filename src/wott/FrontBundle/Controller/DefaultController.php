<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        $films = $em->getRepository('wottCoreBundle:Film')->getFilmByPopularity(8);

        $content = $this->render('wottFrontBundle:Default:index.html.twig', array('films' => $films));

        return $content;
    }

    /**
     * @Route("/list/{display}", defaults={"display" = ""}, name="list")
     * @Template()
     */
    public function listAction($display)
    {
        $em=$this->getDoctrine()->getManager();
        $films = $em->getRepository('wottCoreBundle:Film')->getFilmByPopularity(8);

        if ($display === 'grid') {
        $content = $this->render('wottFrontBundle:Default:index_grid.html.twig', array(
            'films' => $films));
        } elseif ($display === 'list') {
           $content = $this->render('wottFrontBundle:Default:index_list.html.twig', array(
            'films' => $films));
        }

        return $content;

    }

    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }

    /**
     * @Route("/mentions", name="mentions")
     * @Template()
     */
    public function mentionsAction()
    {
        return array();
    }

}
