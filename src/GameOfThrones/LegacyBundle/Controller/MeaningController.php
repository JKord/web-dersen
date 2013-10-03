<?php
namespace GameOfThrones\LegacyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/Meaning")
 */
class MeaningController extends Controller
{
    /**
     * @Route("/", name="meaning")
     * @Template()
     */
    public function indexAction()
    {
        return new Response('Meaning');
    }
}
