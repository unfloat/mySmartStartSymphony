<?php

namespace BidBundle\Controller;

use BidBundle\Entity\Bid;
use BidBundle\Form\BidType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BidController extends Controller
{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function bidsAction()
    {
        //$this->denyAccessUnlessGranted('ROLE_EMPLOYER', null, 'Unable to access this page mthrfkn employer!');
        return $this->render('BidBundle:Freelancer:active_bids.html.twig');
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function manageBiddersAction()
    {
        return $this->render('BidBundle:Employer:manage_bidders.html.twig');
        //, array(
        //            // ...
        //        ));
    }

    public function createBidAction(Request $request)
    {
        $bid = new Bid();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(BidType::class,$bid);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($bid);
            $em->flush();

        }
        return $this->render('@Bid/Freelancer/placebidsidebar.html.twig',['form'=>$form->createView()]);

    }



}
