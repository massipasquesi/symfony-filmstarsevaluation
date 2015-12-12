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

    /**
     * [defineKeyMapper description]
     * @return [type] [description]
     */
    protected function defineKeyMapper()
    {
        $this->keyMapper = array(
            'title',
            'directeur',
            'year',
        );
    }

    /**
     * [defineDemoFixtures description]
     * @return [type] [description]
     */
    protected function defineDemoFixtures()
    {
        $this->demoFixtures = array(
            array('Forrest Gump', 'Robert Zemeckis', '1994'),
            array('La ligne verte', 'Frank Darabont', '2000'),
            array('Django Unchained', 'Quentin Tarantino', '2013'),
            array('Rain Man', 'Barry Levinson', '1988'),
        );
    }

    /**
     * [load description]
     * @param  ObjectManager $manager [description]
     * @return [type]                 [description]
     */
    public function load(ObjectManager $manager)
    {
        $this->easyLoad($manager);
    }

    public function getOrder()
    {
        return 1;
    }

    

}