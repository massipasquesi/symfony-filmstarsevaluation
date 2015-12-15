<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\DataFixtures\ORM\LoadFixturesMaster;
use AppBundle\Entity\Movie;
use AppBundle\Entity\MovieCategory;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMovieData extends LoadFixturesMaster
{
    protected $demoFixturesArray = array(
        array('Forrest Gump', 'Robert Zemeckis', '1994', 2),
        array('La ligne verte', 'Frank Darabont', '2000', 3),
        array('Django Unchained', 'Quentin Tarantino', '2013', 4),
        array('Rain Man', 'Barry Levinson', '1988', 3),
    );

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
            'category' => 'category',
        );
    }

    public function getOrder()
    {
        return 2;
    }

    public function setCategoryType(ObjectManager $manager, $id)
    {
        $category = $manager
            ->getRepository('AppBundle:Category')
            ->find($id);

        $this->newFObject->setCategory($category);
    }

    

}