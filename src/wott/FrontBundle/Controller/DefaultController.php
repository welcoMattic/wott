<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\Formulaire;
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
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction(Request $request )
    {
        $form = $this->createFormBuilder()
            ->add('Nom', 'text')
            ->add('Prenom', 'text')
            ->add('Email', 'email')
            ->add('Message', 'textarea')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            var_dump($form->getData());

            $email = $form->get('Email')->getData();
            $text = $form->get('Message')->getData();
            $message = \Swift_Message::newInstance()
            ->setSubject('Formualaire de contact WOTT !')
            ->setFrom($email)
            ->setTo('suggest@wott.fr')
            ->setBody($text)
            ;

            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('homepage'));
        }

        return array(
            'form' => $form->createView(),
        );
    
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
