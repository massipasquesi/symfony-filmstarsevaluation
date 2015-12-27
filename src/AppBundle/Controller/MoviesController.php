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
        return $this->moviesListAction($request);
    }

    /**
     * @Route("/movies/list", name="movies_list")
     */
    public function moviesListAction(Request $request)
    {
        $query = $this->getDoctrine()
            ->getRepository('AppBundle:Movie')
            ->getAllMoviesQueryBuilder();

        //$movies = $repository->findAll();

        $paginator  = $this->get('knp_paginator');
        $movies = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            Movie::NUM_ITEMS /*limit per page*/
        );

        return $this->render('movies/list.html.twig', array('movies' => $movies));
    }
}
