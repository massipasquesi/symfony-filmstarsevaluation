<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Movie;
use AppBundle\Form\MovieSearchType;

class MoviesAjaxController extends Controller
{
    /**
     * @Route("/ajax/movies/search", name="ajax_movies_search")
     */
    public function ajaxMoviesSearchAction(Request $request)
    {
        //$request = $this->container->get('request');

        $query = $this->getDoctrine()
                ->getRepository('AppBundle:MovieSearch')
                ->search($form->getData());

        $movies = $query->getResult();

        // Prepare the response
        $response = array("code" => 100, "success" => true, 'movies' => $movies);

        // Return result as JSON
        return new Response(json_encode($response));
    }
}
