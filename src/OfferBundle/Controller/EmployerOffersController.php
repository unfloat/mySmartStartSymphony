<?php

namespace OfferBundle\Controller;

use OfferBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class EmployerOffersController extends Controller
{
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function listOffersAction(Request $request)
    {

        $waitingOffers=$this->getDoctrine()->getRepository(Offer::class)->findWaitingOffers();
        $nbr=count($waitingOffers);

        $em    = $this->get('doctrine.orm.entity_manager');
        if($request->getMethod()=="POST")
        {
            $offerName=$request->get('SearchName');
            $dql   = "SELECT o FROM OfferBundle:Offer o where o.name  like :key ";
            $query = $em->createQuery($dql)->setParameter('key', '%'.$offerName.'%');

        }
        else{
            $dql   = "SELECT o FROM OfferBundle:Offer o  WHERE o.status='En Attente'";
            $query = $em->createQuery($dql);
        }


        //$listOffers = $query->getResult();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('@Offer/Offer/EmployerOffers.html.twig',array(
            'offers'=>$pagination,
            'waitingOffers'=>$nbr));
    }
}
