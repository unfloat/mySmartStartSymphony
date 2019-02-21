<?php

namespace DashboardBundle\Controller;

use NoteBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DashboardController extends Controller

{


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function freelancerDashboardAction()
    {
        return $this->render('DashboardBundle:Dashboard:freelancer_dashboard.html.twig');
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function employerDashboardAction()
    {
        return $this->render('DashboardBundle:Dashboard:employer_dashboard.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function newAction(Request $request)
    {
        //parameters from request
        $noteText = $request->get('note');
        $priorityText = $request->get('priority');

        //if fields empty
        if ($priorityText == '' && $noteText == '') {
            return new JsonResponse(["message" => 'Pirority and Note are required', "validate" => false]);
        }
        if ($priorityText == '') {
            return new JsonResponse(["message" => 'Priority is required', "validate" => false]);
        } else if ($noteText == '') {
            return new JsonResponse(["message" => 'Note is required', "validate" => false]);
        } else if ($request->isXmlHttpRequest()) {
            //fields filled and request made
            $note = new Note();
            $note->setNoteText($noteText);
            $note->setPriority($priorityText);


            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            $url = $this->generateUrl('freelancer_dashboard');

            return new JsonResponse(["message" => 'Note added :)', "validate" => true, "redirect" => $url]);
        }


    }
}
