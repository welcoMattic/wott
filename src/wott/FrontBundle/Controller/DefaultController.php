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

        if($display === 'grid'){
        $content = $this->render('wottFrontBundle:Default:index_grid.html.twig', array(
            'films' => $films));
        }
        else if($display === 'list'){
           $content = $this->render('wottFrontBundle:Default:index_list.html.twig', array(
            'films' => $films));
        }

        return $content;
        
    }

    /**
     * @Route("filmuser/", name="filmuser")
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
     * @Route("/showFilm/{id}", name="showFilm", requirements={"id" = "\d+"})
     * @Template()
     */
    public function showFilmAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository('wottCoreBundle:Film')->find($id);

        return array('film' => $film);
    }

    /**
     * @Route("/contact/", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }

    /**
     * @Route("/mentions/", name="mentions")
     * @Template()
     */
    public function mentionsAction()
    {
        return array();
    }

}
