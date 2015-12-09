<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Movie;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/movie/{id}", name="movie_show")
     */
    public function movieShowAction(Movie $movie)
    {
        return $this->render('movie/show.html.twig', array(
            'movie'        => $movie,
        ));
    }

    /**
     * @Route("/movie/list", name="movie_list")
     */
    public function movieListAction()
    {
        return $this->render('movie/list.html.twig');
    }

}
