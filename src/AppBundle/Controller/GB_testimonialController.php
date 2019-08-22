<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GB_testimonial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gb_testimonial controller.
 *
 * @Route("gb_testimonial")
 */
class GB_testimonialController extends Controller
{
    /**
     * Lists all gB_testimonial entities.
     *
     * @Route("/", name="gb_testimonial_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gB_testimonials = $em->getRepository('AppBundle:GB_testimonial')->findAll();

        return $this->render('gb_testimonial/index.html.twig', array(
            'gB_testimonials' => $gB_testimonials,
        ));
    }

    /**
     * Creates a new gB_testimonial entity.
     *
     * @Route("/new", name="gb_testimonial_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gB_testimonial = new Gb_testimonial();
        $form = $this->createForm('AppBundle\Form\GB_testimonialType', $gB_testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gB_testimonial);
            $em->flush();

            return $this->redirectToRoute('gb_testimonial_show', array('id' => $gB_testimonial->getId()));
        }

        return $this->render('gb_testimonial/new.html.twig', array(
            'gB_testimonial' => $gB_testimonial,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gB_testimonial entity.
     *
     * @Route("/{id}", name="gb_testimonial_show")
     * @Method("GET")
     */
    public function showAction(GB_testimonial $gB_testimonial)
    {
        $deleteForm = $this->createDeleteForm($gB_testimonial);

        return $this->render('gb_testimonial/show.html.twig', array(
            'gB_testimonial' => $gB_testimonial,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gB_testimonial entity.
     *
     * @Route("/{id}/edit", name="gb_testimonial_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GB_testimonial $gB_testimonial)
    {
        $deleteForm = $this->createDeleteForm($gB_testimonial);
        $editForm = $this->createForm('AppBundle\Form\GB_testimonialType', $gB_testimonial);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gb_testimonial_edit', array('id' => $gB_testimonial->getId()));
        }

        return $this->render('gb_testimonial/edit.html.twig', array(
            'gB_testimonial' => $gB_testimonial,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gB_testimonial entity.
     *
     * @Route("/{id}", name="gb_testimonial_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GB_testimonial $gB_testimonial)
    {
        $form = $this->createDeleteForm($gB_testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gB_testimonial);
            $em->flush();
        }

        return $this->redirectToRoute('gb_testimonial_index');
    }

    /**
     * Creates a form to delete a gB_testimonial entity.
     *
     * @param GB_testimonial $gB_testimonial The gB_testimonial entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GB_testimonial $gB_testimonial)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gb_testimonial_delete', array('id' => $gB_testimonial->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
