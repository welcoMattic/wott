<?php

namespace wott\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use wott\CoreBundle\Entity\Film;
use wott\CoreBundle\Entity\Genre;

class InsertFilmsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('wott:insertFilms')
            ->setDescription('Populate Film entity with TMDB API data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = $this->getContainer()->get('wtfz_tmdb.client');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $genres = $em->getRepository('wottCoreBundle:Genre')->findAll();

        foreach($genres as $genre) {
            $res = $client->getGenresApi()->getMovies(
                        $genres[0]->getApiId(),
                        array('page' => 1, 'language' => 'fr', 'include_adult' => 'false')
                    );
            $basicFilms = $res['results'];

            foreach($basicFilms as $basicFilm) {
                var_dump($basicFilm);die();
                if ($em->getRepository('wottCoreBundle:Film')->findOneBy(array('api_id' => $basicFilm['id']))) {
                    $f = new Film();
                    if(!$f->getGenres()->contains($genre)) {
                        $f->addGenre($genre);
                        $em->persist($f);
                    }
                } else {
                    $film = $client->getMoviesApi()->getMovie(
                                $basicFilm['id'],
                                array('language' => 'fr', 'append_to_response' => 'releases,trailers,images,reviews')
                            );
                    var_dump($film);
                    $f = new Film();
                    $f->setTitle($film['title']);
                    $f->setOriginalTitle($film['original_title']);
                }
            }

        }

        $i = 0;
        // foreach ($genres as $genre) {
        //     if (!$em->getRepository('wottCoreBundle:Genre')->findOneBy(array('apiId' => $genre['id']))) {
        //         $g = new Genre();
        //         $g->setApiId($genre['id']);
        //         $g->setName($genre['name']);
        //         $em->persist($g);
        //         $i++;
        //     }
        // }

        // $em->flush();

        $output->writeln(($i === 1) ? $i . ' film inserted' : $i . ' films inserted');
    }
}