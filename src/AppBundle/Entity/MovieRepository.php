<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Movie;

class MovieRepository extends EntityRepository
{
    public function getMoviesIdsListQueryBuilder()
    {
        return $this
            ->createQueryBuilder('m')
            ->select(array('m.id'))
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(Movie::NUM_ITEMS);
    }
}
