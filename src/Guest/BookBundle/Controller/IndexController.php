<?php
namespace Guest\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Guest\BookBundle\Entity\Guest,
    Guest\BookBundle\Form\GuestBookType;

class IndexController extends Controller
{
    public function indexAction()
    {
        $request = $this->getRequest();
        $repository = $this->container->get('guest_book.repositoryData');

        $guest = new Guest();
        $form = $this->createForm(new GuestBookType(), $guest);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $this->container->get('guest_book.repositoryData')->add($guest);

                return $this->redirect($this->generateUrl('guest_book_homepage'));
            }
        }

        return $this->render('GuestBookBundle:Default:index.html.twig',
            array(
                'reviews' => $repository->getAll(),
                'entity' => $guest,
                'form'   => $form->createView()
            ));
    }
}