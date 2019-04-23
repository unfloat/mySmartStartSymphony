<?php

namespace OfferBundle\Controller;

use OfferBundle\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OfferDetailsController extends Controller
{
    public function readOfferAction($id)
    {
        $offer=$this->getDoctrine()->getRepository( Offer::class)->findOneBy(['id'=>$id]);
        $listOffer=$this->getDoctrine()->getRepository( Offer::class)->findAll();
        $relatedOffers=$this->getDoctrine()->getRepository( Offer::class)->findBy(array('name'=>$offer->getName()));
        return $this->render('@Offer/Offer/OfferDetails.html.twig',array('offer'=>$offer,
            'listOffers'=>$listOffer,
            'relatedOffers'=>$relatedOffers));
    }
}
