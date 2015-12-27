<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Movie;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MovieToStringTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (movie) to a string (title).
     *
     * @param  Movie|null $issue
     * @return string
     */
    public function transform($movie)
    {
        if (null === $movie) {
            return '';
        }

        return $movie->__toString();
    }

    /**
     * Transforms a string (title) to an object (movie).
     *
     * @param  string $movieTitle
     * @return Movie|null
     * @throws TransformationFailedException if object (movie) is not found.
     */
    public function reverseTransform($movieTitle)
    {
        // no movie title? It's optional, so that's ok
        if (!$movieTitle) {
            return;
        }

        $movie = $this->manager
            ->getRepository('AppBundle:Movie')
            // query for the movie with this title
            ->findOneByTitle($movieTitle)
        ;

        if (null === $movie) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'A movie with title "%s" does not exist!',
                $movieTitle
            ));
        }

        return $movie;
    }
}
