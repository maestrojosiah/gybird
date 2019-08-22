<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GB_presentation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gb_presentation controller.
 *
 * @Route("gb_presentation")
 */
class GB_presentationController extends Controller
{
    /**
     * Lists all gB_presentation entities.
     *
     * @Route("/", name="gb_presentation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gB_presentations = $em->getRepository('AppBundle:GB_presentation')->findAll();

        return $this->render('gb_presentation/index.html.twig', array(
            'gB_presentations' => $gB_presentations,
        ));
    }

    /**
     * Creates a new gB_presentation entity.
     *
     * @Route("/new/{car_id}", name="gb_presentation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $car_id)
    {
        // $gB_presentation = new Gb_presentation();
        // $form = $this->createForm('AppBundle\Form\GB_presentationType', $gB_presentation);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($gB_presentation);
        //     $em->flush();

        //     return $this->redirectToRoute('gb_presentation_show', array('id' => $gB_presentation->getId()));
        // }

        // return $this->render('gb_presentation/new.html.twig', array(
        //     'gB_presentation' => $gB_presentation,
        //     'form' => $form->createView(),
        // ));

        $gB_presentation = new Gb_presentation();
        $form = $this->createForm('AppBundle\Form\GB_presentationType', $gB_presentation);
        $form->handleRequest($request);
        $car = $this->em()->getRepository('AppBundle:GB_car')->find($car_id);
        $gB_presentation->setcar($car);
        $gB_presentation->setUser($this->user());
        $gB_presentation->setPDeleted(0);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo_path = $form->get('pPhotoPath')->getData();
            $make = $car->getCMake();
            $gB_presentation->setPDeleted(0);            
            $car_title = $car->getCModel();
            $trimmed_title = str_replace(" ", "_", $car_title);
            $originalName = $photo_path->getClientOriginalName();;
            $filepath = $this->get('kernel')->getProjectDir()."/web/img/cars/$make/$trimmed_title/";
            $photo_path->move($filepath, $originalName);
            $simple_filepath = "/img/cars/$make/$trimmed_title/";
            $gB_presentation->setPPhotoPath($simple_filepath . $originalName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($gB_presentation);
            $em->flush();

            return $this->redirectToRoute('gb_presentation_new', array('car_id' => $car_id));
        }

        return $this->render('gb_presentation/new.html.twig', array(
            'gB_presentation' => $gB_presentation,
            'car' => $car,
            'form' => $form->createView(),
        ));

    }

    /**
     * Finds and displays a gB_presentation entity.
     *
     * @Route("/{id}", name="gb_presentation_show")
     * @Method("GET")
     */
    public function showAction(GB_presentation $gB_presentation)
    {
        $deleteForm = $this->createDeleteForm($gB_presentation);

        return $this->render('gb_presentation/show.html.twig', array(
            'gB_presentation' => $gB_presentation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gB_presentation entity.
     *
     * @Route("/{id}/edit", name="gb_presentation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GB_presentation $gB_presentation)
    {
        $deleteForm = $this->createDeleteForm($gB_presentation);
        $editForm = $this->createForm('AppBundle\Form\GB_presentationType', $gB_presentation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gb_presentation_edit', array('id' => $gB_presentation->getId()));
        }

        return $this->render('gb_presentation/edit.html.twig', array(
            'gB_presentation' => $gB_presentation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gB_presentation entity.
     *
     * @Route("/{id}", name="gb_presentation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GB_presentation $gB_presentation)
    {
        $form = $this->createDeleteForm($gB_presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gB_presentation);
            $em->flush();
        }

        return $this->redirectToRoute('gb_presentation_index');
    }

    /**
     * Creates a form to delete a gB_presentation entity.
     *
     * @param GB_presentation $gB_presentation The gB_presentation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GB_presentation $gB_presentation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gb_presentation_delete', array('id' => $gB_presentation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function em(){
        $em = $this->getDoctrine()->getManager();
        return $em;
    }

    private function user(){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $user;
    }


}
