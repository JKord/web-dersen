<?php
namespace GameOfThrones\MorsWestfordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/Vasteras")
 */
class VasterasController extends Controller
{
    function getMasNumber($count)
    {
        $mas = array();
        for($i = 0; $i < $count; $i++)
            $mas[] = rand();

        return $mas;
    }

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $numbers['points'] = array(
            'name' => array('Бал','Балла','Балів'),
            'ch' => $this->getMasNumber(20)
        );
        $numbers['pieces'] = array(
            'name' => array('Штука','Штуки','Штук'),
            'ch' => $this->getMasNumber(30)
        );

        return array('numbers' => $numbers);
    }
}
