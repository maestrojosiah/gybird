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

        $car_makes = [];

        foreach ($gB_cars as $key => $value) {
            $car_makes[] = $value->getCMake();
        }

        $c_m = array_unique($car_makes);

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'gB_cars' => $gB_cars,
            'car_makes' => $c_m,
        ]);
    }
}
