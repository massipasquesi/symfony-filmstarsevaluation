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
        return $this->moviesListAction();
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
