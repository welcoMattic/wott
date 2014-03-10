<?php

namespace wott\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use wott\CoreBundle\Entity\People;
use wott\CoreBundle\Entity\FilmPeople;

class InsertPeoplesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wott:insertPeoples')
            ->setDescription('Populate People entity with TMDB API data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getContainer()->get('wtfz_tmdb.client');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $films = $em->getRepository('wottCoreBundle:Film')->findAll();
        $progress = $this->getHelperSet()->get('progress');
        $progress->start($output, count($films));
        $i = 0;

        foreach ($films as $film) {
            $res = $client->getMoviesApi()->getCredits(
                        $film->getApiId(),
                        array('language' => 'fr')
                    );
            $basicPeoples = array_merge($res['cast'], $res['crew']);

            foreach ($basicPeoples as $basicPeople) {
                $people = $client->getPeopleApi()->getPerson(
                    $basicPeople['id'],
                    array('language' => 'fr')
                );
                if(!isset($people['name']) || $em->getRepository('wottCoreBundle:People')->findOneBy(array('api_id' => $basicPeople['id'])))
                    continue;
                $i++;

                $filmPeople = new FilmPeople();
                $filmPeople->setFilm($film);

                $p = new People();
                $p->setName($people['name']);
                $p->setBiography($people['biography']);
                $p->setBirthday($people['birthday'] && preg_match( '`^\d{4}-d{2}-d{2}$`' , $people['birthday'] ) ? new \DateTime($people['birthday']) : null);
                $p->setDeathday($people['deathday'] && preg_match( '`^\d{4}-d{2}-d{2}$`' , $people['deathday'] ) ? new \DateTime($people['deathday']) : null);
                $p->setNationality($people['place_of_birth']);
                $p->setUrlProfileImage($people['profile_path']);
                $p->setApiId($people['id']);

                $filmPeople->setPeople($p);
                !isset($basicPeople['job'])       ?: $filmPeople->setJob($basicPeople['job']);
                !isset($basicPeople['character']) ?: $filmPeople->setRole($basicPeople['character']);

                $em->persist($filmPeople);

            }
            $progress->advance();
        }

        $progress->finish();
        $em->flush();

        $output->writeln(($i === 1) ? $i . ' people inserted' : $i . ' peoples inserted');
    }
}
