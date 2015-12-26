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
        // Build the form
        $user = new User();

        /*****************************************************
         * Add List of Movies with possibility to evaluate  *
         *****************************************************/
        $movies_ids = $this->getDoctrine()
                ->getRepository('AppBundle:Movie')
                ->getMoviesIdsList();
        
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

        // Handle the submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Encode the password
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('movies_list');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
