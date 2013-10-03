<?php
namespace GameOfThrones\MorsWestfordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/BlackCastle")
 */
class BlackCastleController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
