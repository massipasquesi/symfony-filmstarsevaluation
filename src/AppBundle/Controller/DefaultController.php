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
        $root_dir = $this->get('kernel')->getRootDir();
        $readme_path = $root_dir . '/../' . 'README.html';

        return $this->render('default/index.html.twig', array(
            'readme_path' => $readme_path,
        ));
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
