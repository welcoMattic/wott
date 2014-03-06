<?php

namespace wott\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
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
        $progress = $this->getHelperSet()->get('progress');
        $progress->start($output, count($genres));
        $i = 0;
        $addedFilms = [];

        foreach ($genres as $genre) {
            $res = $client->getGenresApi()->getMovies(
                        $genre->getApiId(),
                        array('page' => 1, 'language' => 'fr', 'include_adult' => 'false')
                    );
            foreach ($res['results'] as $basicFilm) {
                if ($em->getRepository('wottCoreBundle:Film')->findOneBy(array('api_id' => $basicFilm['id'])) == null) {
                    if (!in_array($basicFilm['id'], $addedFilms)) {
                        $film = $client->getMoviesApi()->getMovie(
                                    $basicFilm['id'],
                                    array('language' => 'fr', 'append_to_response' => 'trailers')
                                );

                        $images = $client->getMoviesApi()->getImages($basicFilm['id'],
                                    array('language' => 'fr', 'include_image_language' => 'fr')
                                );

                        $f = new Film();

                        $break = false;
                        foreach ($film['genres'] as $genre) {
                            if ($genre['id'] == 10762) {
                                $break = true;
                                continue;
                            }
                            $g = $em->getRepository('wottCoreBundle:Genre')->findOneBy(array('api_id' => $genre['id']));
                            $f->addGenre($g);
                        }
                        if($break) continue;

                        $f->setApiId($film['id']);
                        $f->setTitle($film['title']);
                        $f->setOriginalTitle($film['original_title']);
                        $f->setReleaseDate(new \DateTime($film['release_date']));
                        $f->setSynopsis($film['overview'] ? $film['overview'] : '.');
                        $f->setRuntime($film['runtime'] ? $film['runtime'] : 0);
                        $f->setPopularity($film['popularity']);
                        $f->setUrlPoster(!empty($images['posters']) ? $images['posters'][0]['file_path'] : '');

                        $f->setNationalities(array_reduce($film['production_countries'], function ($current, $next) {
                                                return ($current != '') ? $current . ',' . $next['name'] : $next['name'];
                                            }));

                        if (!empty($film['trailers']['youtube'])) {
                            $f->setUrlTrailer($film['trailers']['youtube'][0]['source']);
                        }

                        $em->persist($f);
                        $i++;
                        $addedFilms[] = $basicFilm['id'];
                    }
                }
            }
            $progress->advance();
        }

        $em->flush();
        $progress->finish();

        $output->writeln(($i === 1) ? $i . ' film inserted' : $i . ' films inserted');
    }
}
