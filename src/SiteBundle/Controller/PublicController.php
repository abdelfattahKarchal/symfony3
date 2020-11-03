<?php

namespace SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PublicController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('SiteBundle:Public:index.html.twig');
    }

}
