<?php

namespace Study\AspirinaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Study\AspirinaBundle\Entity\Dcf;
use Study\AspirinaBundle\Form\DcfType;

/**
 * Dcf controller.
 *
 * @Route("/dcf")
 */
class DcfController extends Controller
{
    /**
     * Lists all Dcf entities.
     *
     * @Route("/", name="dcf")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AspirinaBundle:Dcf')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Dcf entity.
     *
     * @Route("/", name="dcf_create")
     * @Method("POST")
     * @Template("AspirinaBundle:Dcf:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Dcf();
        $form = $this->createForm(new DcfType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('dcf_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Dcf entity.
     *
     * @Route("/new", name="dcf_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Dcf();
        $form   = $this->createForm(new DcfType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Dcf entity.
     *
     * @Route("/{id}", name="dcf_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Dcf')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dcf entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Dcf entity.
     *
     * @Route("/{id}/edit", name="dcf_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Dcf')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dcf entity.');
        }

        $editForm = $this->createForm(new DcfType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Dcf entity.
     *
     * @Route("/{id}", name="dcf_update")
     * @Method("PUT")
     * @Template("AspirinaBundle:Dcf:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AspirinaBundle:Dcf')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dcf entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new DcfType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('dcf_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Dcf entity.
     *
     * @Route("/{id}", name="dcf_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AspirinaBundle:Dcf')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dcf entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('dcf'));
    }

    /**
     * Creates a form to delete a Dcf entity by id.
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
