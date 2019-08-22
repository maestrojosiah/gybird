<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GB_model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gb_model controller.
 *
 * @Route("gb_model")
 */
class GB_modelController extends Controller
{
    /**
     * Lists all gB_model entities.
     *
     * @Route("/", name="gb_model_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gB_models = $em->getRepository('AppBundle:GB_model')->findAll();

        return $this->render('gb_model/index.html.twig', array(
            'gB_models' => $gB_models,
        ));
    }

    /**
     * Creates a new gB_model entity.
     *
     * @Route("/new", name="gb_model_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gB_model = new Gb_model();
        $form = $this->createForm('AppBundle\Form\GB_modelType', $gB_model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gB_model);
            $em->flush();

            return $this->redirectToRoute('gb_model_show', array('id' => $gB_model->getId()));
        }

        return $this->render('gb_model/new.html.twig', array(
            'gB_model' => $gB_model,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gB_model entity.
     *
     * @Route("/{id}", name="gb_model_show")
     * @Method("GET")
     */
    public function showAction(GB_model $gB_model)
    {
        $deleteForm = $this->createDeleteForm($gB_model);

        return $this->render('gb_model/show.html.twig', array(
            'gB_model' => $gB_model,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gB_model entity.
     *
     * @Route("/{id}/edit", name="gb_model_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GB_model $gB_model)
    {
        $deleteForm = $this->createDeleteForm($gB_model);
        $editForm = $this->createForm('AppBundle\Form\GB_modelType', $gB_model);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gb_model_edit', array('id' => $gB_model->getId()));
        }

        return $this->render('gb_model/edit.html.twig', array(
            'gB_model' => $gB_model,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gB_model entity.
     *
     * @Route("/{id}", name="gb_model_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GB_model $gB_model)
    {
        $form = $this->createDeleteForm($gB_model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gB_model);
            $em->flush();
        }

        return $this->redirectToRoute('gb_model_index');
    }

    /**
     * Creates a form to delete a gB_model entity.
     *
     * @param GB_model $gB_model The gB_model entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GB_model $gB_model)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gb_model_delete', array('id' => $gB_model->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
