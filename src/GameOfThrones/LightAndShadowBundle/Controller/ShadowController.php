<?php
namespace GameOfThrones\LightAndShadowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/Light")
 */
class LightController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return new Response('Light');
    }
}
