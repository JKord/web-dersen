<?php

namespace Catalog\FilmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CatalogFilmsBundle:Default:index.html.twig', array());
    }
}
