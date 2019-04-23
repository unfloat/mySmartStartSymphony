<?php

namespace OfferBundle\Controller;

use OfferBundle\Entity\Category;
use OfferBundle\Entity\Offer;
use OfferBundle\Entity\Skills;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use UserBundle\Entity\Employer;


class OfferDetailsController extends Controller
{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function readOfferAction($id)
    {
        $offer=$this->getDoctrine()->getRepository( Offer::class)->findOneBy(['id'=>$id]);
        $listOffer=$this->getDoctrine()->getRepository( Offer::class)->findAll();
        $relatedOffers=$this->getDoctrine()->getRepository( Offer::class)->findBy(array('name'=>$offer->getName()));
        $skills=$this->getDoctrine()->getRepository( Skills::class)->findBy(array('offer'=>$id));
        $employer = $offer->getEmployer();



        return $this->render('@Offer/Offer/OfferDetails.html.twig',array('offer'=>$offer,
            'listOffers'=>$listOffer,
            'relatedOffers'=>$relatedOffers,
            'skills'=>$skills,
        'employer'=>$employer));
    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */


    public function acceptOfferAction (Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository(Offer::class)->find($id);

        $offer->setStatus("accepted");

        $em->persist($offer);
        $em->flush();
        return $this->redirectToRoute('offer_readOne',array(
            'id' => $id,
        ));
    }
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function rejectOfferAction (Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository(Offer::class)->find($id);

        $offer->setStatus("rejected");

        $em->persist($offer);
        $em->flush();
        return $this->redirectToRoute('offer_readOne',array(
            'id' => $id,
        ));
    }




}
