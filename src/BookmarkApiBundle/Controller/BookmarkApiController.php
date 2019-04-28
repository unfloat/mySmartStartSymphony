<?php

namespace BookmarkApiBundle\Controller;

use BookmarkBundle\Entity\Bookmark;
use ProjectBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use UserBundle\Entity\Freelancer;
use UserBundle\Entity\User;


class BookmarkApiController extends Controller
{



    public function allBookmarksAction($id)
    {
        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        $bookmarks = $this->getDoctrine()->getRepository(Bookmark::class)
            ->findBy(["freelancer" => $id]);
        $projectCallback = function ($project) {
            return $project instanceof Project ? $projectProps = ["projectName" => $project->getProjectName(),
                "projectDescription" => $project->getProjectDescription()] : '';
        };

        $normalizer->setCallbacks(['project' => $projectCallback]);
        $normalizer->setIgnoredAttributes(['freelancer']);


        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($bookmarks);

        return new JsonResponse($formatted);

    }

    public function findBookmarkAction($id)
    {

        $encoder = new JsonEncoder();
        $normalizer = new GetSetMethodNormalizer();
        $bookmark = $this->getDoctrine()->getRepository(Bookmark::class)
            ->find($id);
        $projectCallback = function ($project) {
            return $project instanceof Project ? $projectProps = ["projectName" => $project->getProjectName(),
                "projectDescription" => $project->getProjectDescription()] : '';
        };

        $normalizer->setCallbacks(['project' => $projectCallback]);
        $normalizer->setIgnoredAttributes(['freelancer']);


        $serializer = new Serializer([$normalizer], [$encoder]);
        $formatted = $serializer->normalize($bookmark);

        return new JsonResponse($formatted);
    }

    public function placeBookmarkAction(Request $request)
    {

        try {
            $dateAdded = new \DateTime("now");
        } catch (\Exception $e) {
        };
        var_dump($dateAdded);

            //$request->get('dateAdded');
        $project = $this->getDoctrine()->getRepository(Project::class)
            ->findOneBy(["id" => $request->get('project')]);
        $freelancer = $this->getDoctrine()->getRepository(Freelancer::class)
            ->findOneBy(["id" => $request->get('freelancer')]);
        //$data = json_decode($request->getContent(), true);

        if(empty($freelancer))
        {
            return new Response(Response::HTTP_NOT_ACCEPTABLE);
        }

        $bookmark = new Bookmark();

        $bookmark->setProject($project);
        $bookmark->setDateAdded($dateAdded);
        $bookmark->setFreelancer($freelancer);
        $em = $this->getDoctrine()->getManager();

        $em->persist($bookmark);
        $em->flush();

        $encoder = new JsonEncoder();

        $normalizer = new GetSetMethodNormalizer();


        $projectCallback = function ($project) {
            return $project instanceof Project ? $projectProps = ["projectName" => $project->getProjectName(),
                "minBudget" => $project->getMinBudget(),
                "maxBudget" => $project->getMaxBudget()]
                : '';
        };

        $normalizer->setCallbacks(['project' => $projectCallback]);
        $normalizer->setIgnoredAttributes(['freelancer']);

        $serializer = new Serializer([$normalizer], [$encoder]);

        $formatted = $serializer->normalize($bookmark);

        $jsonContent = new JsonResponse($formatted);
        $response = new Response($jsonContent, 200);

        return $response;

    }

    public function editBookmarkAction(Request $request)
    {
        $dateAdded = $request->get('dateAdded');
        $hourlyRate = $request->get('hourlyRate');
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $bid = $this->getDoctrine()->getRepository(Bid::class)
            ->find($id);

        if (empty($bid)) {
            return new Response(Response::HTTP_NOT_FOUND);
        }
        elseif(!empty($deliveryTime) && !empty($hourlyRate)){

            $bid->setDeliveryTime($deliveryTime);
            $bid->setMinimalRate($hourlyRate);
            $em->flush();
            return new Response(Response::HTTP_OK);
        }
        elseif(empty($deliveryTime) && !empty($hourlyRate)){

            $bid->setMinimalRate($hourlyRate);
            $em->flush();
            return new Response(Response::HTTP_OK);
        }
        elseif(!empty($deliveryTime) && empty($hourlyRate)){

            $bid->setDeliveryTime($deliveryTime);
            $em->flush();
            return new Response(Response::HTTP_OK);
        }

        return new Response(Response::HTTP_NOT_ACCEPTABLE);


    }


}
