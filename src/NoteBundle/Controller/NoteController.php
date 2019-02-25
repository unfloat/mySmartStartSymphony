<?php

namespace NoteBundle\Controller;

use NoteBundle\Entity\Note;
use NoteBundle\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class NoteController extends Controller
{

    public function create_self_noteAction(Request $request)
    {
        $note = new Note();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(NoteType::class,$note);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute('self_notes');
        }
        return $this->render('@Note/Freelancer/self_notes.html.twig',['form'=>$form->createView()]);

    }


    public function self_notesAction()
    {
        $notes= $this->getDoctrine()->getRepository(Note::class)->findAll();
        return $this->render('@Note/Freelancer/self_notes.html.twig',["notes" => $notes]);
    }


    public function delete_selfNoteAction(Note $note)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();
        return $this->redirectToRoute('self_notes');
    }

}
