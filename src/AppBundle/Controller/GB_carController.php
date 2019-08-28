<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GB_car;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

        $gB_cars = $em->getRepository('AppBundle:GB_car')->findBy(
            array('deleted' => 0),
            array('id' => 'DESC')
        );

        return $this->render('gb_car/index.html.twig', array(
            'gB_cars' => $gB_cars,
        ));
    }

    /**
     * Lists all gB_car entities with photos.
     *
     * @Route("/all", name="gb_car_show_all")
     * @Method("GET")
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gB_cars = $em->getRepository('AppBundle:GB_car')->findBy(
            array('deleted' => 0),
            array('id' => 'DESC')
        );

        $car_makes = [];

        foreach ($gB_cars as $key => $value) {
            $car_makes[] = $value->getCMake();
        }

        $c_m = array_unique($car_makes);



        return $this->render('gb_car/index_all.html.twig', array(
            'gB_cars' => $gB_cars,
            'car_makes' => $c_m,
        ));
    }

    /**
     * Lists all deleted gB_car entities.
     *
     * @Route("/deleted", name="gb_car_deleted_index")
     * @Method("GET")
     */
    public function deletedAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gB_cars = $em->getRepository('AppBundle:GB_car')->findBy(
            array('deleted' => 1),
            array('id' => 'DESC')
        );

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

            return $this->redirectToRoute('gb_car_show_admin', array('id' => $gB_car->getId()));
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
     * Finds and displays a gB_car entity to admin
     * @Route("/admin/{id}", name="gb_car_show_admin")
     * @Method("GET")
     */
    public function showAdminAction(GB_car $gB_car)
    {
        $deleteForm = $this->createDeleteForm($gB_car);

        return $this->render('gb_car/show_admin.html.twig', array(
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
        $formerFileName = $gB_car->getImage();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $image = $editForm->get('image')->getData();
            $make = $editForm->get('cMake')->getData();
            $model = $editForm->get('cModel')->getData();
            $now = date("d-m-Y h:i:s");
            $stamp = date("dmYhis");
            $gB_car->setUploaded(new \DateTime($now));            
            $gB_car->setDeleted(0);            
            $gB_car_make = $editForm->get('cMake')->getData();
            $gB_car_model = $editForm->get('cModel')->getData();
            $trimmed_make = str_replace(" ", "_", $gB_car_make);
            $trimmed_model = str_replace(" ", "_", $gB_car_model);
            $trimmed_title = $trimmed_make . $trimmed_model;

            $originalName = $image->getClientOriginalName();
            $filepath = $this->get('kernel')->getProjectDir()."/web/img/gB_cars/$trimmed_make/$trimmed_title/";
            $image->move($filepath, $originalName);
            $simple_filepath = "/img/gB_cars/$trimmed_make/$trimmed_title/";
            $gB_car->setImage($simple_filepath . $originalName);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

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
     * @Route("/delete/{id}", name="gb_car_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GB_car $gB_car)
    {
 
        if ($gB_car->getDeleted() == 1) {
            $gB_car->setDeleted(0);
        } else {
            $gB_car->setDeleted(1);
        }
            
        $em = $this->getDoctrine()->getManager();
        $em->persist($gB_car);
        $em->flush();
       

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
