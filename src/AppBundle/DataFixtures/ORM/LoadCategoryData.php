<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\ORM\LoadFixturesMaster;
use AppBundle\Entity\Category;

class LoadCategoryData extends LoadFixturesMaster
{
    protected $demoFixturesArray = array(
        array(1, 'Comique'),
        array(2, 'Comedie'),
        array(3, 'Drammatique'),
        array(4, 'Aventure'),
        array(5, 'Action'),
        array(6, 'Science Fiction'),
        array(7, 'Animation'),
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