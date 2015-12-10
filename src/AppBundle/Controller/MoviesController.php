<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Movie;

class MoviesController extends Controller
{
    /**
     * @Route("/movies", name="movies")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/movies/{id}", name="movie_show")
     */
    public function movieShowAction(Movie $movie)
    {
        return $this->render('movies/show.html.twig', array(
            'movie'        => $movie,
        ));
    }

    /**
     * @Route("/movies/list", name="movies_list")
     */
    public function movieListAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Movie');

        $movies = $repository->findAll();

        return $this->render('movies/list.html.twig', array('movies', $movies));
    }

}
