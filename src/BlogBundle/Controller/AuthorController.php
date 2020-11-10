<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * @Route("author/create")
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();
        $author = new Author();
        $author->setFirstname('halima');
        $author->setLastname('abbaoui');

        $em->persist($author);
        $em->flush();

        return new Response('create author');
    }

    /**
     * @Route("/author")
     */
    public function indexAction()
    {
        return $this->render('BlogBundle:Author:index.html.twig', array(
            // ...
        ));
    }

}
