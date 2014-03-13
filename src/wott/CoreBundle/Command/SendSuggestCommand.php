<?php

namespace wott\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\FilmUser;

class SendSuggestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wott:sendSuggest')
            ->setDescription('Send Suggest of film for all users')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
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

    