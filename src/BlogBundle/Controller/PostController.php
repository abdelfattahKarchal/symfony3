<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Image;
use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use tidy;

class PostController extends Controller
{
    /**
     * @Route("post")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('BlogBundle:Post');
        $posts = $em->findAll();
        return $this->render('BlogBundle:Post:index.html.twig', ['posts' => $posts]);
    }


    /**
     * @Route("post/show")
     */
    public function showAction()
    {
        /* // la 1er methode en utilisant createQuery de Manager service
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT p FROM BlogBundle:Post p WHERE p.active = :active AND p.title LIKE :titre ORDER BY p.title DESC");
        $query->setParameter("active",1);
        $query->setParameter("titre","1%");
        $posts =$query->getResult(); */

        // 2eme methode en utilisant createQueryBuilder de Repository service

        $repository = $this->getDoctrine()->getRepository("BlogBundle:Post");
        // le parametre p c est l alias de modele Post 
        $query = $repository->createQueryBuilder("p")
            ->where('p.active = :etat')
            ->andWhere("p.title like :titre")
            ->orderBy('p.title', "DESC")
            ->setParameters(["etat"=>1, "titre"=> '1%'])
            ->getQuery();
        $posts = $query->getResult();

        echo "<pre>", print_r($posts), "</pre>";

        return new Response('show post');
        //return $this->render('BlogBundle:Post:show.html.twig');
    }

    /**
     * @Route("post/create")
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();
        //objet post
        $post = new Post();
        $post->setTitle('1er titre avec categies');
        $post->setSlug('1er-titre avec categies');
        $post->setDescription('1er description avec categies');
        $post->setActive(1);
        //objet Image
        $image = new Image();
        $image->setUrl('https://i0.wp.com/wp.laravel-news.com/wp-content/uploads/2020/03/laravel7.jpg?fit=2200%2C1125&ssl=1?resize=2200%2C1125');
        $image->setAlt('framwork symfony');
       /*  $em->persist($image);
        $em->flush(); */

        // association Many To One with author
        $repositoryAuthor = $em->getRepository('BlogBundle:Author');
        $author = $repositoryAuthor->find(2);

        $post->setAuthor($author);

        //associaton one to one
        $post->setImage($image);

        //association ManyToMany
        $repositoryCategory = $em->getRepository('BlogBundle:Category');
        $categories = $repositoryCategory->findAll();
        foreach ($categories as  $category) {
            $post->addCategory($category);
        }

        $em->persist($post);
        $em->flush();

        return new Response('created post');
    }
}
