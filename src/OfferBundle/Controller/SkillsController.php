<?php

namespace OfferBundle\Controller;

use OfferBundle\Entity\Skills;
use OfferBundle\Form\SkillsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkillsController extends Controller
{


    public function readAction(){
        $skills=$this->getDoctrine()->getRepository( Skills::class)->findAll();

        return $this->render('@Offer/Skills/readSkills.html.twig',array('skills'=>$skills));
    }



    public function createAction(Request $request)
    { //create an object to store our data after the form submission
        $skills = new Skills();
        //prepare the form with the function createForm()
        $form=$this->createForm(SkillsType::class,$skills);
        //extract the form answer from the received request
        $form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($skills);
            $em->flush();
            return $this->redirect($this->generateUrl(''));
        }
        return $this->render('@Offer/Skills/createSkills.html.twig',
            array(
                'form'=>$form->createView()
            ));
    }


    public function updateAction(Request $request, $id){
        //first step: //get the modele with $id with manager permission
        $em=$this->getDoctrine()->getManager();
        $skills = $em->getRepository(Skills::class)->find($id);
        //third step: // check is the from is sent
        if ($request->isMethod('POST')) {
            //update our object given the sent data in the request
            $skills->setName($request->get('name'));
            $skills->setCategory($request->get('category'));

            //fresh the data base
            $em->flush();
            //Redirect to the read
            return $this->redirectToRoute('Skills_read');
            //second step: // send the view to the user

        }
        return $this->render('@Offer/Skills/update.html.twig', array( 'skills' => $skills
        ));

    }


    public function deleteAction($id) {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $skills= $em->getRepository(Skills::class)->find($id);
        //remove from the ORM
        $em->remove($skills);
        //update the data base
        $em->flush();
        return $this->redirectToRoute("Skills_read");
    }


}
