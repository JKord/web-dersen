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

    /**
     * @Route("/description", name="meaning_description")
     * @Template()
     */
    public function descriptionAction()
    {
        $des = array(
            'The system works satisfactorily, and the owner sees no reason for changing it.',
            'The costs of redesigning or replacing the system are prohibitive because it is large, monolithic, and/or complex.',
            'Retraining on a new system would be costly in lost time and money, compared to the anticipated appreciable benefits of replacing it (which may be zero).',
            'The system requires near-constant availability, so it cannot be taken out of service, and the cost of designing a new system with a similar availability level is high.',
            'The way that the system works is not well understood. Such a situation can occur when the designers of the system have left the organization, and the system has either not been fully documented or documentation has been lost.',
            'The user expects that the system can easily be replaced when this becomes necessary.'
        );

        return array('des' => $des);
    }
}
