<?php

namespace wott\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use wott\CoreBundle\Entity\User;
use wott\CoreBundle\Entity\Film;

/**
 * FilmUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmUserRepository extends EntityRepository
{

    public function getFilmsUser(User $user, $action)
    {
        $qb = $this->createQueryBuilder('fu');
        $query = $qb->select('fu, f')
                    ->join('fu.film', 'f')
                    ->where('fu.user = :user')
                    ->andWhere('fu.is'. ucfirst($action) .' = true')
                    ->setParameter('user', $user)
                    ->getQuery();

        return $query->getResult();
    }

    public function suggest(User $user)
    {
    	$films = array();
        $seenFilms = array();

        $em = $this->getEntityManager();
        $likedFilmsByUser = $this->getFilmsUser($user, 'like');
        $seenFilmsUser = $this->getFilmsUser($user, 'seen');
        foreach ($seenFilmsUser as $seenFilmUser) {
            $seenFilms[] = $seenFilmUser->getFilm();
        }
        foreach ($likedFilmsByUser as $likedFilmByUser) {
            foreach ($likedFilmByUser->getFilm()->getGenres() as $genre) {
                $filmsByLikedGenres = $em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity(10, $genre);
                foreach ($filmsByLikedGenres as $filmsByLikedGenre) {
                    if (!in_array($filmsByLikedGenre, $seenFilms) && !in_array($filmsByLikedGenre, $films))
                        $films[] = $filmsByLikedGenre;
                }
            }
        }

        if(count($films) == 0){
        	$popularFilms=$em->getRepository('wottCoreBundle:Film')->getFilmsByPopularity(10);
        	foreach ($popularFilms as $popularFilm) {
        		$films[]=$PopularFilm;
        	}
        	
        }

        return $films;
    }

}
