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
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity(8);

        return array('films' => $films);
    }

    /**
     * @Route("/list/{display}/{genre}", defaults={"display" = "", "genre" = null}, name="list")
     * @Template()
     */
    public function listAction($display, $genre)
    {
        $em = $this->getDoctrine()->getManager();
        $genre = $em->getRepository('wottCoreBundle:Genre')->find($genre);

        $films = $em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity(8, $genre);

        if ($display === 'grid') {
            $content = $this->render('wottFrontBundle:Default:index_grid.html.twig', array('films' => $films));
        } elseif ($display === 'list') {
            $content = $this->render('wottFrontBundle:Default:index_list.html.twig', array('films' => $films));
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
