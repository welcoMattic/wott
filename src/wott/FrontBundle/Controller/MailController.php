<?php

namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\FilmUser;

/**
 * @Route("/mail")
 */
class MailController extends Controller
{

    /**
     * @Route("/suggest", name="sendSuggest")
     * @Template()
     */
    public function sendSuggestAction()
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('wottCoreBundle:User')->find($id);
        $films = $em->getRepository('wottCoreBundle:FilmUser')->suggest($user);
        $email= $user->getEmail();

        $message = \Swift_Message::newInstance()
        ->setSubject('Tonight on TV !')
        ->setFrom('suggest@wott.fr')
        ->setTo($email)
        ->setBody($this->renderView('wottFrontBundle:Mail:suggest.html.twig', array('films' => $films)))
        ;

        $this->get('mailer')->send($message);

        return array();

    }

}
