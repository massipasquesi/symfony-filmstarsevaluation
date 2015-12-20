<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Evaluation;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $user = new User();

        /*****************************************************
         * Add List of Movies with possibility to evaluate  *
         *****************************************************/
        $mqb = $this->getDoctrine()
                ->getRepository('AppBundle:Movie')
                ->getMoviesIdsListQueryBuilder();

        $movies_ids = $mqb->getQuery()->getArrayResult();
        
        foreach ($movies_ids as $i => $id) {
            $evaluation[$i] = new Evaluation();
            $movie[$i] = $this->getDoctrine()
                ->getRepository('AppBundle:Movie')
                ->find($id);
            $evaluation[$i]->setMovie($movie[$i]);
            $user->getEvaluations()->add($evaluation[$i]);
        }
        /*****************************************************
         *        END added functionality                    *
         *****************************************************/

        $form = $this->createForm(new UserType(), $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like send them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('replace_with_some_route');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
