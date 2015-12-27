<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/dump", name="dump_page")
     */
    public function dumpAction()
    {
        // $subscriber = new \AppBundle\EventListener\FileUploadSubscriber($this->get('kernel')->getRootDir());

        // $data = $subscriber->rootDir;
        $data = $this->get('kernel');

        return $this->render('default/dump.html.twig', array(
            'data' => $data,
        ));
    }
}
