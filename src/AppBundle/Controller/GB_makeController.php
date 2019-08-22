<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GB_make;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gb_make controller.
 *
 * @Route("gb_make")
 */
class GB_makeController extends Controller
{
    /**
     * Lists all gB_make entities.
     *
     * @Route("/", name="gb_make_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gB_makes = $em->getRepository('AppBundle:GB_make')->findAll();

        return $this->render('gb_make/index.html.twig', array(
            'gB_makes' => $gB_makes,
        ));
    }

    /**
     * Creates a new gB_make entity.
     *
     * @Route("/new", name="gb_make_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gB_make = new Gb_make();
        $form = $this->createForm('AppBundle\Form\GB_makeType', $gB_make);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gB_make);
            $em->flush();

            return $this->redirectToRoute('gb_make_show', array('id' => $gB_make->getId()));
        }

        return $this->render('gb_make/new.html.twig', array(
            'gB_make' => $gB_make,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gB_make entity.
     *
     * @Route("/{id}", name="gb_make_show")
     * @Method("GET")
     */
    public function showAction(GB_make $gB_make)
    {
        $deleteForm = $this->createDeleteForm($gB_make);

        return $this->render('gb_make/show.html.twig', array(
            'gB_make' => $gB_make,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gB_make entity.
     *
     * @Route("/{id}/edit", name="gb_make_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GB_make $gB_make)
    {
        $deleteForm = $this->createDeleteForm($gB_make);
        $editForm = $this->createForm('AppBundle\Form\GB_makeType', $gB_make);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gb_make_edit', array('id' => $gB_make->getId()));
        }

        return $this->render('gb_make/edit.html.twig', array(
            'gB_make' => $gB_make,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gB_make entity.
     *
     * @Route("/{id}", name="gb_make_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GB_make $gB_make)
    {
        $form = $this->createDeleteForm($gB_make);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gB_make);
            $em->flush();
        }

        return $this->redirectToRoute('gb_make_index');
    }

    /**
     * Creates a form to delete a gB_make entity.
     *
     * @param GB_make $gB_make The gB_make entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GB_make $gB_make)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gb_make_delete', array('id' => $gB_make->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
