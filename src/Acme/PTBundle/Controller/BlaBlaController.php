<?php

namespace Acme\PTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/blabla")
*/
class BlaBlaController extends Controller
{
    /**
    * @Route("/")
    * @Template()
    */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/")
     * @Template()
     */
    public function descriptionAction()
    {
        return array('description' => array('caption' => 'Раки', 'text' => 'Бо вони Раки!'));
    }
}
