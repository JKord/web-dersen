<?php

namespace Catalog\FilmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Catalog\FilmsBundle\Entity\Films;
use Catalog\FilmsBundle\Form\FilmsType;

/**
 * Films controller.
 *
 */
class FilmsController extends Controller
{

    /**
     * Lists all Films entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CatalogFilmsBundle:Films')->findAll();

        return $this->render('CatalogFilmsBundle:Films:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Films entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Films();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setImage($form['image']->getData());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('catalog_films_films_show', array('id' => $entity->getId())));
        }

        return $this->render('CatalogFilmsBundle:Films:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Films entity.
    *
    * @param Films $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Films $entity)
    {
        $form = $this->createForm(new FilmsType($this->get('catalog_films.helper_method')), $entity, array(
            'action' => $this->generateUrl('catalog_films_films_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Films entity.
     *
     */
    public function newAction()
    {
        $entity = new Films();
        $form   = $this->createCreateForm($entity);

        return $this->render('CatalogFilmsBundle:Films:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Films entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CatalogFilmsBundle:Films')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Films entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CatalogFilmsBundle:Films:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Films entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CatalogFilmsBundle:Films')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Films entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CatalogFilmsBundle:Films:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Films entity.
    *
    * @param Films $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Films $entity)
    {
        $form = $this->createForm(new FilmsType($this->get('catalog_films.helper_method')), $entity, array(
            'action' => $this->generateUrl('catalog_films_films_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Films entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CatalogFilmsBundle:Films')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Films entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setImage($editForm['image']->getData());
            $em->flush();

            return $this->redirect($this->generateUrl('catalog_films_films_edit', array('id' => $id)));
        }

        return $this->render('CatalogFilmsBundle:Films:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Films entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CatalogFilmsBundle:Films')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Films entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('catalog_films_films'));
    }

    /**
     * Creates a form to delete a Films entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catalog_films_films_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
