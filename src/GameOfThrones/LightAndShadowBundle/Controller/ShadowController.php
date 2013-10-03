<?php
namespace GameOfThrones\LightAndShadowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/Shadow")
 */
class ShadowController extends Controller
{
    /**
     * @Route("/", name="shadow")
     */
    public function indexAction()
    {
        return new Response('Shadow');
    }

    /**
     * @Route("/Saruman", name="shadow_saruman")
     * @Template()
     */
    public function sarumanAction()
    {
        return array();
    }
}
