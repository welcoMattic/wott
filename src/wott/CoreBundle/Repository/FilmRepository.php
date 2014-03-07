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
    public function getFilmByPopularity($limit)
    {

        $qb = $this->_em->createQueryBuilder();

        $qb->select('a')
                    ->from('wottCoreBundle:Film', 'a')
                    ->orderBy('a.popularity', 'DESC')
                    ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }

   
}
