<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Image;
use BlogBundle\Entity\Post;
use BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use tidy;

class PostController extends Controller
{
    /**
     * @Route("post", name="index_post")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('BlogBundle:Post');
        $posts = $em->findAll();
        return $this->render('BlogBundle:Post:index.html.twig', ['posts' => $posts]);
    }


    /**
     * @Route("post/show/{id}", name="show_post")
     */
    public function showAction($id)
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
       /*  $query = $repository->createQueryBuilder("p")
            ->where('p.active = :etat')
            ->andWhere("p.title like :titre")
            ->orderBy('p.title', "DESC")
            ->setParameters(["etat"=>1, "titre"=> '1%'])
            ->getQuery();
        $posts = $query->getResult(); */

        $post = $repository->find($id);

       /*  echo "<pre>", print_r($posts), "</pre>"; */

        //return new Response('show post');
        return $this->render('BlogBundle:Post:show.html.twig',['post' => $post]);
    }

    /**
     * @Route("post/create", name="create_post")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //objet post
        $post = new Post();
        // creation de formulaire a l aide du service form.factory
        /* $formPost = $this->get('form.factory')->createBuilder(FormType::class,$post)
                            ->add('title',TypeTextType::class, ['attr'=> ['placeholder'=>'title of post', 'class'=>'textClass']])
                            ->add('description', TextareaType::class)
                            ->add('slug',TypeTextType::class)
                            ->add('active',CheckboxType::class)
                            ->add('enregistrer', SubmitType::class); */
         
        // externalisation de formulaire PostType via la commande bin/console doctrine:generate:form BlogBundle:Post 
        $formPost = $this->get('form.factory')->createBuilder(PostType::class,$post);                 
          
         $form = $formPost->getForm();

         if ($request->isMethod('POST')) {
             // association des elements de request a l objet form
             $form->handleRequest($request);
             if ($form->isValid()) {
                //objet Image
             /* $image = new Image();
             $image->setUrl('https://i0.wp.com/wp.laravel-news.com/wp-content/uploads/2020/03/laravel7.jpg?fit=2200%2C1125&ssl=1?resize=2200%2C1125');
             $image->setAlt('framwork symfony'); */
            // $em->persist($image);
             //$em->flush(); 
     
             // association Many To One with author
             $repositoryAuthor = $em->getRepository('BlogBundle:Author');
             $author = $repositoryAuthor->find(2);
     
             $post->setAuthor($author);
     
             //associaton one to one
             //$post->setImage($image);
     
             //association ManyToMany
             $repositoryCategory = $em->getRepository('BlogBundle:Category');
             $categories = $repositoryCategory->findAll();
             foreach ($categories as  $category) {
                 $post->addCategory($category);
             }
     
             $em->persist($post);
             $em->flush();

             //return $this->redirectToRoute('show_post',['id'=> $post->getId()]);
             $request->getSession()->getFlashBag()->add('success','Post a ete bien enregistre');
             return $this->redirectToRoute('index_post');
            }

             
         }
         
         return $this->render('BlogBundle:Post:create.html.twig',['formulaire'=> $form->createView()]);

       /*  */

        //return new Response('created post');
    }
}
