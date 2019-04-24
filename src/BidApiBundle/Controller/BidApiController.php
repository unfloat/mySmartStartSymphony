<?php

namespace BidApiBundle\Controller;

use BidBundle\Entity\Bid;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class BidApiController extends Controller
{

    public function allBidsAction()
    {
        $bids = $this->getDoctrine()->getRepository(Bid::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($bids);
        return new JsonResponse($formatted);
    }

    public function findBidAction($id)
    {
        $tasks = $this->getDoctrine()->getManager()
            ->getRepository('BidBundle:Bid')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tasks);
        return new JsonResponse($formatted);
    }

    public function placeBidAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $bid = new Bid();
        $bid->setDeliveryTime($request->get('deliveryTime'));
        $bid->setMinimalRate($request->get('hourlyRate'));
        $em->persist($bid);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($bid);
        return new JsonResponse($formatted);
    }
}
