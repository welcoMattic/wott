<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

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
     * @Route("/list/{display}", defaults={"display" = ""}, name="list")
     * @Template()
     */
    public function listAction($display)
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity(8);

        if ($display === 'grid') {
            $content = $this->render('wottFrontBundle:Default:index_grid.html.twig', array('films' => $films));
        } elseif ($display === 'list') {
            $content = $this->render('wottFrontBundle:Default:index_list.html.twig', array('films' => $films));
        }

        return $content;
    }


    /**
     * @Route("/profile/", name="")
     * @Template("SonataUserBundle:Profile:show.html.twig")
     */
    public function profileAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $FilmUser = $em->getRepository('wottCoreBundle:FilmUser');

        $filmsUser = $FilmUser->getIsWantedFilms($user);

        return array('films' => $filmsUser);
        
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
