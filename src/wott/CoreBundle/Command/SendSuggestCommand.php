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

        $date = date('D');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $users = $em->getRepository('wottCoreBundle:User')->findAll();


        foreach ($users as $user) {
            if ($user->getSuggestDay() && in_array($date, $user->getSuggestDay())) {
                $films = $em->getRepository('wottCoreBundle:FilmUser')->suggest($user);
                $email= $user->getEmail();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Tonight on TV !')
                    ->setFrom('suggest@wott.fr')
                    ->setTo($email)
                    ->setBody($this->getContainer()->get('templating')->render('wottFrontBundle:Mail:suggest.html.twig', array('films' => $films)));

                $this->getContainer()->get('mailer')->send($message);

                $output->writeln('mail send to '.$email);
            }
        }

    }

}

