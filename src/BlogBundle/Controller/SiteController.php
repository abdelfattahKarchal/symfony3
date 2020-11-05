<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SiteController extends Controller
{
    /**
     * @Route("/acceuil",name = "site_acceuil")
     */
    public function acceuilAction()
    {
        return $this->render('BlogBundle:Site:acceuil.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/service",name = "site_service")
     */
    public function serviceAction()
    {
        return $this->render('BlogBundle:Site:service.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/contact",name = "site_contact")
     */
    public function contactAction()
    {
        return $this->render('BlogBundle:Site:contact.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/show/{id}",name = "site_show")
     */
    public function showAction($id)
    {
        return $this->render('BlogBundle:Site:show.html.twig', [
            'id'=> $id
        ]);
    }

}
