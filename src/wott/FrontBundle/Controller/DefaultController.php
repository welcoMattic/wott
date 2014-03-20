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

        $paginator  = $this->get('knp_paginator');
    	$pagination = $paginator->paginate(
        $films,
        $this->get('request')->query->get('page', 1),
        4
    	);


        return array('films' => $films, 'pagination' => $pagination);
    }

    /**
     * @Route("/list/{page}/{display}/{genre}", defaults={"page" = 1, display" = "", "genre" = null}, name="list")
     * @Template()
     */
    public function listAction($page, $display, $genre)
    {
    	$limit=8*$page;
        $offset=$limit-8;

        $em = $this->getDoctrine()->getManager();
        $genre = $em->getRepository('wottCoreBundle:Genre')->find($genre);
        $films = $em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity($limit, $genre, $offset);

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
            ->add('Envoyer', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            die();

            $email = $form->get('Email')->getData();
            $text = $form->get('Message')->getData();
            $message = \Swift_Message::newInstance()
            ->setSubject('Formualaire de contact WOTT !')
            ->setFrom($email)
            ->setTo('gregory.joly.14@gmail.com')
            ->setBody($text)
            ;

            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add(
            'notice',
            'Votre E-mail a correctement été envoyé !'
        );
            //return $this->redirect($this->generateUrl('homepage'));
        }

        return array(
            'form' => $form->createView(),
        );
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
