<?php

namespace Catalog\FilmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Catalog\FilmsBundle\Entity\Genres;
use Catalog\FilmsBundle\Form\GenresType;

/**
 * Genres controller.
 *
 */
class GenresController extends Controller
{

    /**
     * Lists all Genres entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CatalogFilmsBundle:Genres')->findAll();

        return $this->render('CatalogFilmsBundle:Genres:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Genres entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Genres();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('catalog_films_genres_show', array('id' => $entity->getId())));
        }

        return $this->render('CatalogFilmsBundle:Genres:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Genres entity.
    *
    * @param Genres $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Genres $entity)
    {
        $form = $this->createForm(new GenresType(), $entity, array(
            'action' => $this->generateUrl('catalog_films_genres_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Genres entity.
     *
     */
    public function newAction()
    {
        $entity = new Genres();
        $form   = $this->createCreateForm($entity);

        return $this->render('CatalogFilmsBundle:Genres:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Genres entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CatalogFilmsBundle:Genres')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genres entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CatalogFilmsBundle:Genres:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Genres entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CatalogFilmsBundle:Genres')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genres entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CatalogFilmsBundle:Genres:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Genres entity.
    *
    * @param Genres $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Genres $entity)
    {
        $form = $this->createForm(new GenresType(), $entity, array(
            'action' => $this->generateUrl('catalog_films_genres_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Genres entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CatalogFilmsBundle:Genres')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Genres entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('catalog_films_genres_edit', array('id' => $id)));
        }

        return $this->render('CatalogFilmsBundle:Genres:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Genres entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CatalogFilmsBundle:Genres')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Genres entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('catalog_films_genres'));
    }

    /**
     * Creates a form to delete a Genres entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catalog_films_genres_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
