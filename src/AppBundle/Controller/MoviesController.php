<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Movie;

use AppBundle\DataFixtures\ORM\LoadMovieData;

class MoviesController extends Controller
{
    /**
     * @Route("/movies", name="movies")
     */
    public function indexAction(Request $request)
    {
        $MovieData = new LoadMovieData();
        $data = $MovieData->getDemoFixtures();

        return $this->render('movies/drafts.html.twig', array(
            'data' => $data,
        ));
    }

    /**
     * @Route("/movies/list", name="movies_list")
     */
    public function moviesListAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Movie');

        $movies = $repository->findAll();

        return $this->render('movies/list.html.twig', array('movies' => $movies));
    }
}
