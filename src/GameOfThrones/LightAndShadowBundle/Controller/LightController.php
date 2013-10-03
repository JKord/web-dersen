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
     * @Route("/", name="light")
     */
    public function indexAction()
    {
        return new Response('Light');
    }

    /**
     * @Route("/Gandalf", name="light_gandalf")
     * @Template()
     */
    public function gandalfAction()
    {
        return array();
    }
}
