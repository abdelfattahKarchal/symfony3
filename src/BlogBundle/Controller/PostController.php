<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
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
        $data = [
            [
                "id" => 1,
                "titre" => "Titre de post",
                "post" => "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                    impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500,
                    quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser
                    un livre spécimen de polices de texte.",
                "datepublication" => date('Y-m-d')
            ],
            [
                "id" => 2,
                "titre" => "Titre de post",
                "post" => "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                    impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500,
                    quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser
                    un livre spécimen de polices de texte.",
                "datepublication" => date('Y-m-d')
            ],
            [
                "id" => 3,
                "titre" => "Titre de post",
                "post" => "Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                    impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500,
                    quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser
                    un livre spécimen de polices de texte.",
                "datepublication" => date('Y-m-d')
            ]
        ];
        return $this->render('BlogBundle:Post:index.html.twig', ['articles' => $data]);
        return $this->appel();
    }

    public function appel()
    {
        return new Response('je suis dans la fonction appel');
    }

    /**
     * @Route("post/show")
     */
    public function showAction()
    {
        $repositoryPost = $this->getDoctrine()->getRepository("BlogBundle:Post");
        //$posts = $repositoryPost->findAll();
        //$posts = $repositoryPost->findOneByTitle("2eme titre");
        //$posts = $repositoryPost->findByActive(1);
        $posts = $repositoryPost->findBy(['active'=>1],['title'=> 'DESC'],1);

         echo "<pre>", print_r($posts ),"</pre>";

        return new Response('show post');
        //return $this->render('BlogBundle:Post:show.html.twig');
    }

    /**
     * @Route("post/create")
     */
    public function createAction()
    {
        $post = new Post();

        $post->setTitle('2eme titre');
        $post->setDescription('2eme description');
        $post->setActive(1);

        /* $doctrine = $this->getDoctrine();
        $manager = $doctrine->getManager();

        $manager->persist($post);
        // confirmation de persistance (commit)
        $manager->flush(); */

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return new Response('created post');
    }
}
