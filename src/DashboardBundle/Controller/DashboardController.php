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
    public function freealancerDashboardAction()
    {
        $notes = $this->getDoctrine()->getRepository(Note::class)->findAll();
        return $this->render('DashboardBundle:Dashboard:freealancer_dashboard.html.twig', array(
            'notes' => $notes
        ));
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function employerDashboardAction()
    {
        return $this->render('DashboardBundle:Dashboard:employer_dashboard.html.twig', array(
            // ...
        ));
    }

    public function ajaxAction(Request $request) {
        $notes = $this->getDoctrine()
            ->getRepository('NoteBundle:Note')
            ->findAll();

        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {
            $jsonData = array();
            $idx = 0;
            foreach($notes as $note) {
                $temp = array(
                    'priority' => $note->getPriority(),
                    'note' => $note->getNoteText()
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($jsonData);
        } else {
            return $this->render('DashboardBundle:Dashboard:freealancer_dashboard.html.twig');
        }
    }


}
