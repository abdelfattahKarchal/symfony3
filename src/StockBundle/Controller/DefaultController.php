<?php

namespace StockBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('StockBundle:Default:index.html.twig');
    }

    public function showAction($id, $annee, $titre, $ext)
    {
        return new Response("showing stock : $id, $annee, $titre, $ext");
    }
}
