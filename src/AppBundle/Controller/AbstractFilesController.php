<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractFilesController extends Controller
{
    abstract protected function getEntity();
    abstract protected function getFormType();

    protected function fileUploadAction(Request $request, $entity_name)
    {
        // set entity & entityType
        $this->entityName = $entity_name;
        $this->entity = $this->getEntity();
        $this->formType = $this->getFormType();

        // Build the form
        $form = $this->createForm($this->formType, $this->entity);

        // Handle the submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Save the Avatar!
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirectAfterUpload();
        }

        return $this->renderUploadTemplate();
    }

    protected function redirectAfterUpload()
    {
         return $this->redirectToRoute(strtolower($this->entityName));
    }

    protected function renderUploadTemplate()
    {
        return $this->render(
            'common/forms/files/upload.html.twig',
            array('form' => $form->createView())
        );
    }
}
