<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\ORM\AbstractFixturesLoader;
use AppBundle\Entity\Category;

class LoadCategoryData extends AbstractFixturesLoader
{
    protected $demoFixturesArray = array(
        array(1, 'Comique'),
        array(2, 'Comedie'),
        array(3, 'Drammatique'),
        array(4, 'Aventure'),
        array(5, 'Action'),
        array(6, 'Science Fiction'),
        array(7, 'Animation'),
        array(8, 'Western'),
        array(9, 'Fantastique'),
        array(10, 'Thriller'),
    );

    /**
     * [getNewEntityObject description]
     * @return [type] [description]
     */
    protected function getNewEntityObject()
    {
        return new Category();
    }

    protected function declareHeader()
    {
        $this->header = array(
            'id',
            'name',
        );
    }

    public function getOrder()
    {
        return 1;
    }
}
