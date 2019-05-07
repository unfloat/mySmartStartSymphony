<?php

namespace ProjectApiBundle\Controller;


use OfferBundle\Entity\Category;
use OfferBundle\Entity\Skills;
use ProjectBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\DateTime;


class ProjectApiController extends Controller
{

    public function allProjectsMAction(Request $request)
    {
        $projects = $this->getDoctrine()->getManager()
            ->getRepository('ProjectBundle:Project')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($projects);
        return new JsonResponse($formatted);

    }


    public function createProjectMAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $skill = $this->getDoctrine()->getRepository(Skills::class)->find($request->get('idSkill'));
        $category = $this->getDoctrine()->getRepository(Category::class)->find($request->get('idCategory'));

        $project =new Project();

        $project->setProjectName($request->get('projectName'));
        $project->setProjectLocation($request->get('projectLocation'));
        $project->setMinBudget($request->get('minBudget'));
        $project->setMaxBudget($request->get('maxBudget'));
        $project->setProjectDescription($request->get('projectDescription'));
        $project->setAddress($request->get('address'));
        $project->setProjectStartDay(new \DateTime('now'));
        $project->setProjectEndDay(new \DateTime($request->get('projectEndDay')));
        $project->setIdSkill($skill);
        $project->setIdCategory($category);

        $em->persist($project);
        $em->flush();

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {return $object->getId();});
        $serializer = new Serializer([$normalizer]);
        $formatted = $serializer->normalize($project);
        return new JsonResponse($formatted);
    }

}
