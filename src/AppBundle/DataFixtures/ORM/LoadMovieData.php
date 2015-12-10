<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Movie;

class LoadUserData implements FixtureInterface
{
    private $movieDemoFixtures;
    private $movieFixturesMapper = array(
        'title',
        'directeur',
        'year',
        'evaluations',
    );

    public function load(ObjectManager $manager)
    {
        foreach ($this->getMovieDemoFixtures() as $movie_row) {
            $newMovie = new Movie();
            $newMovie->setTitle($movie_row['title']);
            $newMovie->setDirecteur($movie_row['directeur']);
            $newMovie->setYear($movie_row['year']);
            $newMovie->setEvaluations($movie_row['evaluations']);

            $manager->persist($newMovie);
            $manager->flush();

            unset($newMovie);
        }

    }

    private function getMovieDemoFixtures()
    {
        return $this->defineMovieDemoFixtures();
    }

    private function isSetMovieDemoFixtures()
    {
        if (isset($this->movieDemoFixtures) &&
            !empty($this->movieDemoFixtures) &&
            is_array($this->movieDemoFixtures)) {
                return true;
        }

        return false;
    }

    private function defineMovieDemoFixtures()
    {
        if ($this->isSetMovieDemoFixtures() === true) {
            return $this->isSetMovieDemoFixtures();
        }

        $movieDemoFixtures = array(
            array('Forrest Gump', 'Robert Zemeckis', '1994', 0),
            array('La ligne verte', 'Frank Darabont', '2000', 0),
            array('Django Unchained', 'Quentin Tarantino', '2013', 0),
        );

        foreach ($movieDemoFixtures as $index => $movie_row) {
            $this->movieDemoFixtures[$index]['title'] = $movie_row[$this->movieFixturesMapper['title']];
            $this->movieDemoFixtures[$index]['directeur'] = $movie_row[1];
            $this->movieDemoFixtures[$index]['year'] = $movie_row[2];
            $this->movieDemoFixtures[$index]['evaluations'] = $movie_row[3];
        }
    }
}