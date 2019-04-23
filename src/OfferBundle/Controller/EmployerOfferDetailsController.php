<?php

namespace OfferBundle\Controller;

use OfferBundle\Entity\Offer;
use OfferBundle\Entity\Skills;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class EmployerOfferDetailsController extends Controller
{
    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function readOfferAction($id)
    {
        $offer=$this->getDoctrine()->getRepository( Offer::class)->findOneBy(['id'=>$id]);
        $skills=$this->getDoctrine()->getRepository( Skills::class)->findBy(array('offer'=>$id));

        $listOffer=$this->getDoctrine()->getRepository( Offer::class)->findAll();
        return $this->render('@Offer/Offer/EmployerOfferDetails.html.twig',array('offer'=>$offer,
            'listOffers'=>$listOffer,
            'skills'=>$skills));
    }
}
