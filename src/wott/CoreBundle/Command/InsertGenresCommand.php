<?php

namespace wott\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use wott\CoreBundle\Entity\Genre;

class InsertGenresCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wott:insertGenres')
            ->setDescription('Populate Genre entity with TMDB API data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getContainer()->get('wtfz_tmdb.client');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $res = $client->getGenresApi()->getGenres(array('language' => 'fr'));
        $progress = $this->getHelperSet()->get('progress');
        $progress->start($output, count($res['genres']));
        $i = 0;

        foreach ($res['genres'] as $genre) {
            if (!$em->getRepository('wottCoreBundle:Genre')->findOneBy(array('api_id' => $genre['id']))) {
                $g = new Genre();
                $g->setApiId($genre['id']);
                $g->setName($genre['name']);
                $em->persist($g);
                $i++;
            }
            $progress->advance();
        }

        $em->flush();
        $progress->finish();

        $output->writeln(($i === 1) ? $i . ' genre inserted' : $i . ' genres inserted');
    }
}
