<?php

namespace wott\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * FilmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmRepository extends EntityRepository
{

    public function getFilmsByPopularity($limit, $genre = null)
    {
        $qb = $this->createQueryBuilder('f');

        var_dump($genre);

        if($genre) {
          $query = $qb->where('f.genres =  :genres')
                      ->setParameter('genres', $genre)
                      ->orderBy('f.popularity', 'DESC')
                      ->setMaxResults($limit)
                      ->getQuery();
        } else {
          $query = $qb->orderBy('f.popularity', 'DESC')
                      ->setMaxResults($limit)
                      ->getQuery();
        }

        return $query->getResult();
    }

}
