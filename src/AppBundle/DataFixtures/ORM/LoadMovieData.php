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
        array('La ligne verte', 'Frank Darabont', '2000', 9),
        array('Django Unchained', 'Quentin Tarantino', '2013', 8),
        array('Rain Man', 'Barry Levinson', '1988', 3),
        array('Gran Torino', 'Clint Eastwood', '2009', 3),
        array('Shindler List', 'Steven Spielberg', '1994', 3),
        array('Pulp Fiction', 'Quentin Tarantino', '1994', 5),
        array('Le Seigneur des anneaux : le retour du roi', 'Peter Jackson', '2003', 9),
        array('Fight Club', 'David Fincher', '1999', 5),

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
