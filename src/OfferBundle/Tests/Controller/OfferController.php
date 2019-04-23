<?php

namespace OfferBundle\Controller;


use OfferBundle\Entity\Offer;
use OfferBundle\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Freelancer;



class OfferController extends Controller

{
    public function createAction(Request $request)
    {
        $offer = new Offer();
        if($request->getMethod()=="POST")
        {
            $name=$request->get('name');
            $salaryMin=$request->get('salaireMin');
            $salaryMax=$request->get('salaireMax');
            $type=$request->get('Type');
            $description=$request->get('description');
            $location=$request->get('location');

            $freealncer = $this->getDoctrine()->getManager()->getRepository(Freelancer::class)->find(5);

                $offer->setName($name);
                $offer->setPriceMin($salaryMin);
                $offer->setPriceMax($salaryMax);
            $offer->setType($type);
                $offer->setDescription($description);
                $offer->setFreelancer($freealncer);
                $offer->setLocation($location);


            $em=$this->getDoctrine()->getManager();
                $em->persist($offer);
                $em->flush();
        }
        return $this->render('@Offer/Offer/Offer.html.twig');
    }

    public function listOffersAction(Request $request)
    {
        $listOffer=$this->getDoctrine()->getRepository( Offer::class)->findAllOffers();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $listOffer,
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('@Offer/Offer/listOffers.html.twig',array('listOffers'=>$listOffer,
            'offers'=>$pagination));
    }

    public function deleteOfferAction($id) {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $offer= $em->getRepository(Offer::class)->find($id);
        //remove from the ORM
        $em->remove($offer);
        //update the data base
        $em->flush();
        return $this->redirectToRoute("offer_list");
    }

}
