<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Movie;
use AppBundle\Form\MovieSearchType;

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
     * @Route("movies/list", name="movies_list")
     */
    public function moviesListAction(Request $request)
    {
        return $this->moviesListFilteredAction($request);
    }

    /**
     * @Route("/movies/list/simple", name="movies_list_simple")
     */
    public function moviesListSimpleAction(Request $request)
    {
        $movies = $this->getPaginatedSortableMoviesList($request);

        return $this->render('movies/list/table.html.twig', array('movies' => $movies));
    }

    /**
     * @todo : Move into MODEL Logic ?
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    protected function getPaginatedSortableMoviesList(Request $request)
    {
        $query = $this->getDoctrine()
            ->getRepository('AppBundle:Movie')
            ->getAllMoviesQueryBuilder();

        $paginator  = $this->get('knp_paginator');
        $movies = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            Movie::NUM_ITEMS /*limit per page*/
        );

        return $movies;
    }

    /**
     * @Route("/movies/list/filtered", name="movies_list_filtered")
     */
    public function moviesListFilteredAction(Request $request)
    {
        $form = $this->createForm(new MovieSearchType());

        if ($form->isValid()) {
            $query = $this->getDoctrine()
                ->getRepository('AppBundle:MovieSearch')
                ->search($form->getData());

            $movies = $query->getResult();
        } else {
            $movies = $this->getPaginatedSortableMoviesList($request);
        }

        return $this->render(
            'movies/list.html.twig',
            array(
                'movies' => $movies,
                'form' => $form->createView()
            )
        );
    }
}
