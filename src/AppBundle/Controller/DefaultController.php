<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need

        $em = $this->getDoctrine()->getManager();

        $gB_cars = $em->getRepository('AppBundle:GB_car')->findBy(
            array('deleted' => 0),
            array('id' => 'DESC')
        );

        $gB_testimonials = $em->getRepository('AppBundle:GB_testimonial')->findAll();
        $testimonial_chunks = array_chunk($gB_testimonials, 3, true);

        $car_makes = [];
        $car_models = [];
        $steering = [];
        $car_eng_cap = [];
        $car_reg_year = [];
        $car_price = [];

        $latest_car = end($gB_cars);

        foreach ($gB_cars as $key => $value) {
            $car_makes[] = $value->getCMake();
            $car_models[] = $value->getCModel();
            $steering[] = $value->getCSteering();
            $car_eng_cap[] = $value->getCEngCap();
            $car_reg_year[] = $value->getCRegYear();
            $car_price[] = $value->getCPrice();
        }

        $c_m = array_unique($car_makes);
        $c_md = array_unique($car_models);
        $st = array_unique($steering);
        $eng_c = array_unique($car_eng_cap);
        sort($eng_c, SORT_NUMERIC);
        $reg_y = array_unique($car_reg_year);
        sort($reg_y, SORT_NUMERIC);
        $car_p = array_unique($car_price);
        sort($car_p, SORT_NUMERIC);

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'gB_cars' => $gB_cars,
            'car_makes' => $c_m,
            'car_models' => $c_md,
            'steering' => $st,
            'testimonial_chunks' => $testimonial_chunks,
            'testimonials' => $gB_testimonials,
            'latest_car' => $latest_car,
            'car_eng_cap' => $eng_c,
            'car_reg_year' => $reg_y,
            'car_price' => $car_p,
        ]);
    }
}
