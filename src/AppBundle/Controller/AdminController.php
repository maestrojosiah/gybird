<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin_home", name="admin_home_page")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need

        $em = $this->getDoctrine()->getManager();

        $gB_cars = $em->getRepository('AppBundle:GB_car')->findBy(
            array('deleted' => 0),
            array('id' => 'DESC')
        );
        $gB_makes = $em->getRepository('AppBundle:GB_make')->findAll();
        $gB_models = $em->getRepository('AppBundle:GB_model')->findAll();
        $gB_testimonials = $em->getRepository('AppBundle:GB_testimonial')->findAll();

        $car_makes = [];

        foreach ($gB_cars as $key => $value) {
            $car_makes[] = $value->getCMake();
        }

        $c_m = array_unique($car_makes);

        return $this->render('admin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'gB_cars' => $gB_cars,
            'gB_makes' => $gB_makes,
            'gB_models' => $gB_models,
            'gB_testimonials' => $gB_testimonials,
            'car_makes' => $c_m,
        ]);
    }
}
