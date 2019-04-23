<?php

namespace BidBundle\Controller;

use BidBundle\Entity\Bid;
use Doctrine\ORM\OptimisticLockException;
use ProjectBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Freelancer;

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

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function canelBidAction(Request $request)
    {

        $id = $request->get("id");
        $bid =  $this->getDoctrine()->getRepository(Bid::class)->find($id);


        $em = $this->getDoctrine()->getManager();
        $em->remove($bid);
        $em->flush();

        return new JsonResponse(["message" => 'Bid Deleted 🙂']);
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

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
     * @param Project $project
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function manageBiddersAction(Project $project)
    {
        $projectBids = $this->getDoctrine()->getRepository(Bid::class)->findBy(['project'=>$project]);
        $numberBids = count($projectBids);


        return $this->render('BidBundle:Employer:manage_bidders.html.twig',['bids'=>$projectBids,'project'=>$project, 'numberOfBids'=>$numberBids]);
    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     * @param Project $projectid
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function acceptBidAction(Request $request, Freelancer $freelancer,Project $projectid)
    {
        try {
            $manager = $this->get('mgilet.notification');
            $notif = $manager->createNotification('Bid accepted :)');
            $notif->setMessage($projectid->getEmployer()->getUsername().' accepted your bid on  '.$projectid->getProjectName() );
            $notif->setLink('/bids');

            $manager->addNotification([$freelancer], $notif, true);

        } catch (OptimisticLockException $e) {
        }

        return $this->redirectToRoute('employer_dashboard');
    }


}
