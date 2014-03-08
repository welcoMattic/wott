<?php

namespace wott\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use wott\CoreBundle\Entity\Genre;

/**
 * GenreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GenreRepository extends EntityRepository
{

    public function getFilmsByPopularity(Genre $genre, $limit)
    {
        $qb = $this->createQueryBuilder('f');

        $query = $qb->select('f')
                    ->where('f.genre = :genre')
                    ->orderBy('f.popularity', 'DESC')
                    ->setParameter('genre', $this)
                    ->setMaxResults($limit)
                    ->getQuery();

        return $query->getResult();
    }

}
