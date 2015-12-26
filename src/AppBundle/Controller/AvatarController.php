<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Avatar;
use AppBundle\Form\AvatarType;

class AvatarController extends Controller
{
    /**
     * @Route("/avatar", name="avatar")
     */
    public function indexAction(Request $request)
    {
        return $this->avatarUploadAction();
    }

    /**
     * @Route("/avatar/upload", name="avatar_upload")
     */
    public function avatarUploadAction(Request $request)
    {
        $avatar = new Avatar();
        // Build the form
        $form = $this->createForm(new AvatarType(), $avatar);

        // Handle the submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Save the Avatar!
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('avatar');
        }

        return $this->render(
            'common/forms/files/upload.html.twig',
            array('form' => $form->createView())
        );
    }
}
