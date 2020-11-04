<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * @Route("blog",name="blog_list")
     */
    public function indexAction()
    {
        return $this->render('BlogBundle:Blog:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("blog/{id}/{annee}/{titre}.{ext}", name="blog_show", requirements={
     * "id" : "\d+",
     * "annee" : "\d{4}",
     * "titre" : "[a-zA-Z]*",
     * "ext" : "php|html"
     * })
     */
    public function showAction($id, $annee, $titre, $ext = 'php')
    {
        return new Response("show page : $id, $annee, $titre, $ext");
    }
}
