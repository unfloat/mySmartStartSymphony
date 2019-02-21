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
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */


    public function placeBidAction(Request $request,Project $project)
    {

        //parameters from request
        $minimalRate = $request->get('minimalRate');
        $deliveryTime = $request->get('deliveryTime');
        $id = $project->getId();


        if ($request->isXmlHttpRequest()) {
            //fields filled and request made
            $bid = new Bid();
            $bid->setMinimalRate($minimalRate);
            $bid->setDeliveryTime($deliveryTime);
            $bid->setProject($id);


            $em = $this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();

            $url = $this->generateUrl('single_task');

            return new JsonResponse(["message" => 'Bid placed :)', "validate" => true, "redirect" => $url]);
        }
    }

}
