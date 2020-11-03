<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/test")
     */
    public function indexAction()
    {
        //return $this->render('TestBundle:Default:index.html.twig');
        return new Response('je suis dans l action index');
    }
}
