<?php
namespace Catalog\FilmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('CatalogFilmsBundle:Films')->findAll();

        return array('entities' => $entities);
    }
    /**
     * Creates a new Films entity.
     * @Template("CatalogFilmsBundle:Films:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $film = new Films();
        $form = $this->createCreateForm($film);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirect($this->generateUrl('catalog_films_films_show', array('id' => $film->getId())));
        }

        return array('entity' => $film, 'form' => $form->createView());
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
     * @Template()
     * @ParamConverter("film", class="CatalogFilmsBundle:Films")
     */
    public function showAction(Films $film)
    {
        $deleteForm = $this->createDeleteForm($film->getId());
        return array('entity' => $film, 'delete_form' => $deleteForm->createView());
    }

    /**
     * Displays a form to edit an existing Films entity.
     * @Template()
     * @ParamConverter("film", class="CatalogFilmsBundle:Films")
     */
    public function editAction(Films $film)
    {
        $editForm = $this->createEditForm($film);
        $deleteForm = $this->createDeleteForm($film->getId());

        return array(
            'entity'      => $film,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Films entity.
     * @Template("CatalogFilmsBundle:Films:edit.html.twig")
     * @ParamConverter("film", class="CatalogFilmsBundle:Films")
     */
    public function updateAction(Request $request, Films $film)
    {
        $deleteForm = $this->createDeleteForm($film->getId());
        $editForm = $this->createEditForm($film);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('catalog_films_films_edit', array('id' => $film->getId())));
        }

        return array(
            'entity'      => $film,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
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

    /* --------------------------- Create Form ------------------------------------------- */

    /**
     * Creates a form to create a Films entity.
     *
     * @param Films $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Films $entity)
    {
        $form = $this->createForm($this->get('catalog_films.form.type.film'), $entity, array(
            'action' => $this->generateUrl('catalog_films_films_create'),
            'method' => 'POST',
            'attr' => array('enctype' => 'multipart/form-data')
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
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
        $form = $this->createForm($this->get('catalog_films.form.type.film'), $entity, array(
            'action' => $this->generateUrl('catalog_films_films_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('enctype' => 'multipart/form-data')
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
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
