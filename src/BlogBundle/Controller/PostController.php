<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @Route("post")
     */
    public function indexAction()
    {
        $data =[
            "titre" => "Titre de post",
            "post" => "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500,
                quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser
                un livre spécimen de polices de texte.",
               "datepublication" => date('Y-m-d')
        ];
        return $this->render('BlogBundle:Post:index.html.twig', $data);
        return $this->appel();
    }

    public function appel()
    {
        return new Response('je suis dans la fonction appel');
    }
}
