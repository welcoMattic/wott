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

        $FilmUser = $em->getRepository('wottCoreBundle:FilmUser');
        $films = $FilmUser->suggest($user);
        $titles=array();

        $email= $user->getEmail();


 		foreach ($films as $film) {
        	array_push($titles, $film->getTitle());
        }
        $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('suggest@wott.fr')
        ->setTo($email)
        ->setBody($this->renderView('wottFrontBundle:Mail:suggest.html.twig', array('titles' => $titles)))
    	;

    	$this->get('mailer')->send($message);
	
    	return array();

    }

}
