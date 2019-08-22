<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GB_car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gb_car controller.
 *
 * @Route("gb_car")
 */
class GB_carController extends Controller
{
    /**
     * Lists all gB_car entities.
     *
     * @Route("/", name="gb_car_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gB_cars = $em->getRepository('AppBundle:GB_car')->findAll();

        return $this->render('gb_car/index.html.twig', array(
            'gB_cars' => $gB_cars,
        ));
    }

    /**
     * Creates a new gB_car entity.
     *
     * @Route("/new", name="gb_car_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gB_car = new Gb_car();
        $form = $this->createForm('AppBundle\Form\GB_carType', $gB_car);
        $form->handleRequest($request);
        $user = $this->user();

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            $make = $form->get('cMake')->getData();
            $model = $form->get('cModel')->getData();
            $now = date("d-m-Y h:i:s");
            $stamp = date("dmYhis");
            $gB_car->setUploaded(new \DateTime($now));            
            $gB_car->setDeleted(0);            
            $gB_car_make = $form->get('cMake')->getData();
            $gB_car_model = $form->get('cModel')->getData();
            $trimmed_make = str_replace(" ", "_", $gB_car_make);
            $trimmed_model = str_replace(" ", "_", $gB_car_model);
            $trimmed_title = $trimmed_make . $trimmed_model;
            $originalName = $image->getClientOriginalName();
            $filepath = $this->get('kernel')->getProjectDir()."/web/img/gB_cars/$trimmed_make/$trimmed_title/";
            $image->move($filepath, $originalName);
            $simple_filepath = "/img/gB_cars/$trimmed_make/$trimmed_title/";
            $gB_car->setImage($simple_filepath . $originalName);
            $gB_car->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($gB_car);
            $em->flush();

            return $this->redirectToRoute('gb_car_show', array('id' => $gB_car->getId()));
        }

        return $this->render('gb_car/new.html.twig', array(
            'gB_car' => $gB_car,
            'form' => $form->createView(),
        ));

    }

    /**
     * Finds and displays a gB_car entity.
     *
     * @Route("/{id}", name="gb_car_show")
     * @Method("GET")
     */
    public function showAction(GB_car $gB_car)
    {
        $deleteForm = $this->createDeleteForm($gB_car);

        return $this->render('gb_car/show.html.twig', array(
            'gB_car' => $gB_car,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gB_car entity.
     *
     * @Route("/{id}/edit", name="gb_car_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GB_car $gB_car)
    {
        $deleteForm = $this->createDeleteForm($gB_car);
        $editForm = $this->createForm('AppBundle\Form\GB_carType', $gB_car);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gb_car_edit', array('id' => $gB_car->getId()));
        }

        return $this->render('gb_car/edit.html.twig', array(
            'gB_car' => $gB_car,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gB_car entity.
     *
     * @Route("/{id}", name="gb_car_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GB_car $gB_car)
    {
        $form = $this->createDeleteForm($gB_car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gB_car);
            $em->flush();
        }

        return $this->redirectToRoute('gb_car_index');
    }

    /**
     * Creates a form to delete a gB_car entity.
     *
     * @param GB_car $gB_car The gB_car entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GB_car $gB_car)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gb_car_delete', array('id' => $gB_car->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    private function user(){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        return $user;
    }
    
    
}
