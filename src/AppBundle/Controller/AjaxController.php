<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\GB_testimonial;


class AjaxController extends Controller
{

    /**
     * @Route("/review/save", name="save_review")
     */
    public function saveReviewAction(Request $request)
    {
            $review_value = $request->request->get('rating');
            $comment = $request->request->get('comment');
            $car_id = $request->request->get('car_id');
            $now = date("d-m-Y h:i:s");
            $user = $this->get('security.token_storage')->getToken()->getUser();

            $em = $this->getDoctrine()->getManager();
            $car = $this->getDoctrine()
                ->getRepository('AppBundle:GB_car')
                ->find($car_id);


            $testimonial = new GB_testimonial();
            $testimonial->setTComment($comment);
            $testimonial->setSubmitted(new \DateTime($now));            
            $testimonial->setUser($user);
            $testimonial->setTRating($review_value);
            $testimonial->setCar($car);

            $em->persist($testimonial);
            $em->flush();    

            $arrData = ['output' => $review_value ];
            return new JsonResponse($arrData);
        
    }


    /**
     * @Route("/review/edit", name="edit_review")
     */
    public function editReviewAction(Request $request)
    {
            $review_value = $request->request->get('rating');
            $comment = $request->request->get('comment');
            $testimonial_id = $request->request->get('testimonial_id');

            $em = $this->getDoctrine()->getManager();


            $testimonial = $this->getDoctrine()->getRepository('AppBundle:GB_testimonial')->find($testimonial_id);
            $testimonial->setTComment($comment);
            $testimonial->setTRating($review_value);

            $em->persist($testimonial);
            $em->flush();    

            $arrData = ['output' => $review_value ];
            return new JsonResponse($arrData);
        
    }




}
