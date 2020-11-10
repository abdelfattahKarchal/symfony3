<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * @Route("category/create")
     */
    public function createAction()
    {
        $em =$this->getDoctrine()->getManager();
        $categories = ['laravel','symfony','java jee', 'Mean STACK'];
        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->setTitle("$category");

            $em->persist($newCategory);
            $em->flush();
        }
        return new Response('creation category');
    }

}
