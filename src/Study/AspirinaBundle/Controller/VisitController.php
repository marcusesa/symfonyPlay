<?php

namespace Study\AspirinaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Study\AspirinaBundle\Entity\Visit;
use Study\AspirinaBundle\Form\VisitType;

/**
 * Visit controller.
 *
 * @Route("/visit")
 */
class VisitController extends Controller
{
    /**
     * Lists all Visit entities.
     *
     * @Route("/", name="visit")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AspirinaBundle:Visit')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Visit entity.
     *
     * @Route("/", name="visit_create")
     * @Method("POST")
     * @Template("AspirinaBundle:Visit:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Visit();
        $form = $this->createForm(new VisitType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('visit_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Visit entity.
     *
     * @Route("/new", name="visit_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Visit();
        $form   = $this->createForm(new VisitType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Visit entity.
     *
     * @Route("/{id}", name="visit_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Visit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Visit entity.
     *
     * @Route("/{id}/edit", name="visit_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Visit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visit entity.');
        }

        $editForm = $this->createForm(new VisitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Visit entity.
     *
     * @Route("/{id}", name="visit_update")
     * @Method("PUT")
     * @Template("AspirinaBundle:Visit:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Visit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Visit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new VisitType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('visit_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Visit entity.
     *
     * @Route("/{id}", name="visit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AspirinaBundle:Visit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Visit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('visit'));
    }

    /**
     * Creates a form to delete a Visit entity by id.
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
