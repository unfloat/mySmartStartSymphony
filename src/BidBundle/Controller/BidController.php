<?php

namespace BidBundle\Controller;

use BidBundle\Entity\Bid;
use ProjectBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BidController extends Controller
{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function bidsAction()
    {
        $bids= $this->getDoctrine()->getRepository(Bid::class)->findAll();


        return $this->render('BidBundle:Freelancer:active_bids.html.twig',['bids'=>$bids]);
    }

    public function canelBidAction(Request $request)
    {

        $id = $request->get("id");
        $bid =  $this->getDoctrine()->getRepository(Bid::class)->find($id);


        $em = $this->getDoctrine()->getManager();
        $em->remove($bid);
        $em->flush();

        return new JsonResponse(["message" => 'Bid Deleted 🙂']);
    }

    public function editBidAction(Request $request)
    {


        $em = $this->getDoctrine();
        $min = $request->get('min');
        $deliveryTime = $request->get('delivery');
        $id = $request->get("id");

        if (intval($deliveryTime)<= 0){
            return new JsonResponse(["message" => 'No', "validate" => false]);
        }
        else
            {
            $bid =  $this->getDoctrine()->getRepository(Bid::class)->find($id);
            $bid->setDeliveryTime($deliveryTime);
            $bid->setMinimalRate($min);

            $em->getManager()->flush();

            $url = $this->generateUrl('bids');
            return new JsonResponse(["message" => 'Saved Successfully', "validate" => true, "redirect" => $url]);

        }


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
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */


    public function placeBidAction(Request $request,Project $project)
    {

        //parameters from request


            return new JsonResponse(["message" => 'Bid placed :)', "validate" => true]);
    }


}
