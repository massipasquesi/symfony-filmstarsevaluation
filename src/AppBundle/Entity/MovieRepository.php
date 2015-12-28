<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Movie;
use AppBundle\Entity\MovieSearch;

class MovieRepository extends EntityRepository
{
    /**
     * [getMoviesIdsListQueryBuilder description]
     * @return [type] [description]
     */
    public function getMoviesIdsListQueryBuilder()
    {
        return $this
            ->createQueryBuilder('m')
            ->select(array('m.id'))
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(Movie::NUM_ITEMS);
    }

    /**
     * [getMoviesIdsList description]
     * @return [type] [description]
     */
    public function getMoviesIdsList()
    {
        return $this->getMoviesIdsListQueryBuilder()
            ->getQuery()->getArrayResult();
    }

    /**
     * [getAllMoviesQueryBuilder description]
     * @return [type] [description]
     */
    public function getAllMoviesQueryBuilder()
    {
        return $this
            ->createQueryBuilder('m')
            ->select(array('m'))
            ->orderBy('m.title', 'ASC');
    }

    /**
     * [search description]
     * @param  MovieSearch $search [description]
     * @return [type]              [description]
     */
    public function search(MovieSearch $search)
    {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('AppBundle\Entity\Movie', 'm');

        $query = 'SELECT m.* FROM Movie m WHERE 1 ';
        $params = array();

        if (!empty($search->title)) {
            $query .= 'AND m.title LIKE :title%';
            $params['title'] = $title;
        }

        if (!empty($search->director)) {
            $query .= 'AND m.director LIKE :director%';
            $params['director'] = $director;
        }

        if (!empty($search->year)) {
            $query .= 'AND m.year = :year';
            $params['year'] = $title;
        }

        $request = $this->getEntityManager()->createNativeQuery($query, $rsm);
        $request->setParameters($params);

        return $request;
    }
}
