<?php


namespace wott\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\FilmUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/mail")
 */
class MailController extends Controller
{

    /**
     * @Route("/suggest/{id}", name="sendSuggest", requirements={"id" = "\d+"})
     * @Template()
     */
    public function sendSuggestAction($id)
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
