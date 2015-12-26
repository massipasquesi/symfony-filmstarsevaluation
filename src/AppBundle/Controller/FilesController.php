<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Avatar;
use AppBundle\Form\AvatarType;

class FilesController extends Controller
{
    /**
     * @Route("/files", name="files")
     */
    public function indexAction(Request $request)
    {
        return $this->filesUploadAction();
    }

    /**
     * @Route("/files/upload", name="files_upload")
     */
    public function filesUploadAction(Request $request)
    {
        // Build the form
        $avatar = new Avatar();
        $form = $this->createForm(new AvatarType(), $avatar);

        // Handle the submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Save the Avatar!
            $em = $this->getDoctrine()->getManager();
            $em->persist($avatar);
            $em->flush();

            return $this->redirectToRoute('files_upload');
        }

        return $this->render(
            'files/upload.html.twig',
            array('form' => $form->createView())
        );
    }
}
