<?php

namespace NoteBundle\Controller;

use NoteBundle\Entity\Note;
use NoteBundle\Form\NoteType;
use OfferBundle\Entity\Category;
use OfferBundle\Entity\Skills;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class NoteController extends Controller
{


    public function allNotesMAction(Request $request)
    {
        $notes = $this->getDoctrine()->getManager()
            ->getRepository('NoteBundle:Note')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($notes);
        return new JsonResponse($formatted);

    }


    public function createNoteMAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $note =new Note();

        $note->setNoteName($request->get('noteName'));
        $note->setPriority($request->get('priority'));
        $note->setNoteText($request->get('noteText'));

        $em->persist($note);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($note);
        return new JsonResponse($formatted);
    }


    public function deleteNoteMAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $manage_notes=$em->getRepository(Note::class)->find($id);
        $em->remove($manage_notes);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($manage_notes);
        return new JsonResponse($formatted);

    }


    public function updateNoteMAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $manage_notes=$em->getRepository(Note::class)->find($id);

        $manage_notes->setNoteName($request->get('noteName'));
        $manage_notes->setPriority($request->get('priority'));
        $manage_notes->setNoteText($request->get('noteText'));

        $em->persist($manage_notes);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($manage_notes);
        return new JsonResponse($formatted);
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function self_notes_listAction(Request $request,$sortBy="noteName")
    {
        $self_notes_list= $this->getDoctrine()->getRepository(Note::class)->findBy(array(), array($sortBy=>'asc'));
        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $self_notes_list, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 4)/*limit per page*/
        );
        return $this->render('@Note/Freelancer/self_notes_list.html.twig',array('self_notes_list' => $result));
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function create_self_noteAction(Request $request)
    {
        $note = new Note();
        $em = $this->getDoctrine()->getManager();
        $currentuser=$this->getUser();
        $note->setIdFreelancer($currentuser);
        $form = $this->createForm(NoteType::class,$note);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute('self_notes_list');
        }
        return $this->render('@Note/Freelancer/create_self_note.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function delete_self_noteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $self_note=$em->getRepository(Note::class)->find($id);
        $em->remove($self_note);
        $em->flush();
        return $this->redirectToRoute('self_notes_list');

    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function update_self_noteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $self_note=$em->getRepository(Note::class)->find($id);
        $form = $this->createForm(NoteType::class,$self_note);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($self_note);
            $em->flush();
            return $this->redirect($this->generateUrl('self_notes_list'));
        }
        return $this->render('@Note/Freelancer/create_self_note.html.twig',['form'=>$form->createView()]);
    }



    public function searchParametersAction(Request $request)
    {
        $notes=$this->getDoctrine()->getRepository(Note::class)
            ->findParameters(
                $request->get("noteName"),
                $request->get("priority"),
                $request->get("sortBy"));
        $paginator= $this->get('knp_paginator');
        $result=$paginator->paginate(
            $notes, /* query NOT result */
            $request->query->getInt('page', 1),4
        /*$request->query->getInt('limit', 4)/*limit per page*/
        );
        return $this->render('@Note/Freelancer/self_notes_list.html.twig',array("notes"=>$result));

    }

}
