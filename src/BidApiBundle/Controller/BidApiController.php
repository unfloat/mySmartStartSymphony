<?php

namespace BidApiBundle\Controller;

use BidBundle\Entity\Bid;
use ProjectBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UserBundle\Entity\Freelancer;
use UserBundle\Entity\User;

class BidApiController extends Controller
{

    public function allBidsAction($id)
    {
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        //$normalizer = new ObjectNormalizer();
        $bids = $this->getDoctrine()->getRepository(Bid::class)
            ->findBy(["freelancer" => $id]);
        $projectCallback = function ($project) {
            return $project instanceof Project ? $projectProps = ["projectName" => $project->getProjectName(),
                "minBudget" => $project->getMinBudget(),
                "maxBudget" => $project->getMaxBudget()]
                : '';
        };

        $normalizer->setCallbacks(['project' => $projectCallback]);
        $normalizer->setIgnoredAttributes(['freelancer']);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($bids);


        return new JsonResponse($formatted);
    }

    public function placeBidAction(Request $request)
    {
        $deliveryTime = $request->get('deliveryTime');
        $minimalRate = $request->get('minimalRate');
        $project = $this->getDoctrine()->getRepository(Project::class)
            ->findOneBy(["id" => $request->get('project')]);
        $freelancer = $this->getDoctrine()->getRepository(Freelancer::class)
            ->findOneBy(["id" => $request->get('freelancer')]);
        //$data = json_decode($request->getContent(), true);

        if(empty($minimalRate) || empty($deliveryTime) || empty($project) || empty($freelancer))
         {
           return new Response(Response::HTTP_NOT_ACCEPTABLE);
         }

        $bid = new Bid();

        $bid->setDeliveryTime($deliveryTime);
        $bid->setMinimalRate($minimalRate);
        $bid->setProject($project);
        $bid->setFreelancer($freelancer);
        $em = $this->getDoctrine()->getManager();

        $em->persist($bid);
        $em->flush();

        $encoder = new JsonEncoder();

        $normalizer = new GetSetMethodNormalizer();


        $projectCallback = function ($project) {
            return $project instanceof Project ? $projectProps = [
                "projectName" => $project->getProjectName(),
                "projectDescription" => $project->getProjectDescription(),
                "minBudget" => $project->getMinBudget(),
                "maxBudget" => $project->getMaxBudget()
            ]
                : '';
        };

        $normalizer->setCallbacks(['project' => $projectCallback]);
        $normalizer->setIgnoredAttributes(['freelancer']);

        $serializer = new Serializer([$normalizer], [$encoder]);

        $formatted = $serializer->normalize($bid);

        $jsonContent = new JsonResponse($formatted);
        $response = new Response($jsonContent, 200);

        return $response;

    }

    public function findBidAction($id)
    {
        $bid = $this->getDoctrine()->getRepository(Bid::class)
            ->find($id);
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        $bids = $this->getDoctrine()->getRepository(Bid::class)
            ->findBy(["freelancer" => $id]);
        $projectCallback = function ($project) {
            return $project instanceof Project ? $projectProps = ["projectName" => $project->getProjectName(),
                "projectDescription" => $project->getProjectDescription(),
                "minBudget" => $project->getMinBudget(),
                "maxBudget" => $project->getMaxBudget()]
                : '';
        };

        $normalizer->setCallbacks(['project' => $projectCallback]);
        $normalizer->setIgnoredAttributes(['freelancer']);


        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($bid);

        return new JsonResponse($formatted);

    }

    public function editBidAction(Request $request)
    {
       $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $bid = $this->getDoctrine()->getRepository(Bid::class)
            ->find($id);



        $deliveryTime = $request->get('deliveryTime');
        $hourlyRate = $request->get('hourlyRate');

        $encoder = new JsonEncoder();

        $normalizer = new GetSetMethodNormalizer();

        $serializer = new Serializer([$normalizer], [$encoder]);
    


       if (empty($bid)) {
            return new Response(Response::HTTP_NOT_FOUND);
        }

        else{

            $bid->setDeliveryTime($deliveryTime);
            $bid->setMinimalRate($hourlyRate);
            $em->flush();
            $formatted = $serializer->normalize($bid);
            return new JsonResponse($formatted);
        }

    }

    public function deleteBidAction($id, Request $request)
    {
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();

        $bid = $this->getDoctrine()->getRepository(Bid::class)
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($bid);
        $em->flush();

        return new JsonResponse("deleted");

    }

    public function findProjectAction($description){
    $project = $this->getDoctrine()->getRepository(Project::class)
            ->findOneBy(["projectName"=> $description]);
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        
        $employerCallback = function ($employer) {
            return $employer instanceof Employer ? $employerProps = ["employer" => $employer->getType()
                /*,"projectDescription" => $project->getProjectDescription()*/]
                : '';
        };
        $normalizer->setCallbacks(['employer' => $employerCallback]);
        $normalizer->setIgnoredAttributes(['projectBids','projectBookmarks','publishingDate','validityPeriod']);
        

        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($project);
        var_dump($formatted);

        return new JsonResponse($formatted);

}

 public function allProjectsAction(Request $request)
    {
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        //$normalizer = new ObjectNormalizer();
        $bids = $this->getDoctrine()->getRepository(Project::class)
            ->findBy(["freelancer" => $id]);
            
        $employerCallback = function ($employer) {
            return $employer instanceof Employer ? $employerProps = ["employer" => $employer->getType()
                /*,"projectDescription" => $project->getProjectDescription()*/]
                : '';
        };
        $normalizer->setCallbacks(['employer' => $employerCallback]);
        $normalizer->setIgnoredAttributes(['projectBids','projectBookmarks','publishingDate','validityPeriod']);
        

        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($bids);


        return new JsonResponse($formatted);

    }

    public function biddersPerProjectAction($id)
    {
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        //$normalizer = new ObjectNormalizer();
        $bids = $this->getDoctrine()->getRepository(Bid::class)
            ->findBy(["project" => $id]);
        $projectCallback = function ($project) {
            return $project instanceof Project ? $projectProps = ["projectName" => $project->getProjectName(),
                "minBudget" => $project->getMinBudget(),
                "maxBudget" => $project->getMaxBudget()]
                : '';
        };

        $freelancerCallback = function ($freelancer) {
            return $freelancer instanceof Freelancer ? $freelancerProps = ["freelancerName" => $freelancer->getFirstName()]
                : '';
        };


        $normalizer->setCallbacks(['project' => $projectCallback, 'freelancer' => $freelancerCallback ]);

        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($bids);


        return new JsonResponse($formatted);
    }


}
