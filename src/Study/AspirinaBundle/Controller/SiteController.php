<?php

namespace Study\AspirinaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Study\AspirinaBundle\Entity\Site;
use Study\AspirinaBundle\Form\SiteType;

/**
 * Site controller.
 *
 */
class SiteController extends Controller
{
    /**
     * Lists all Site entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AspirinaBundle:Site')->findAll();

        return $this->render('AspirinaBundle:Site:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Site entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Site();
        $form = $this->createForm(new SiteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('site_show', array('id' => $entity->getId())));
        }

        return $this->render('AspirinaBundle:Site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Site entity.
     *
     */
    public function newAction()
    {
        $entity = new Site();
        $form   = $this->createForm(new SiteType(), $entity);

        return $this->render('AspirinaBundle:Site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Site entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AspirinaBundle:Site:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Site entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site entity.');
        }

        $editForm = $this->createForm(new SiteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AspirinaBundle:Site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Site entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SiteType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('site_edit', array('id' => $id)));
        }

        return $this->render('AspirinaBundle:Site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Site entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AspirinaBundle:Site')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Site entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('site'));
    }

    /**
     * Creates a form to delete a Site entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
