<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\DataFixtures\ORM\EasyDemoFixtures;
use AppBundle\Entity\Movie;

class LoadMovieData extends EasyDemoFixtures implements OrderedFixtureInterface
{
    /**
     * [getNewEntityObject description]
     * @return [type] [description]
     */
    protected function getNewEntityObject()
    {
        return new Movie();
    }

    protected function declareHeader()
    {
        $this->header = array(
            'title',
            'directeur',
            'year',
        );
    }

    public function getOrder()
    {
        return 1;
    }

    

}