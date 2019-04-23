<?php

namespace OfferBundle\Controller;

use OfferBundle\Entity\Category;
use OfferBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    public function readAction(){
        $category=$this->getDoctrine()->getRepository( Category::class)->findAll();

        return $this->render('@Offer/Category/read.html.twig',array('category'=>$category));
    }



    public function createAction(Request $request)
    { //create an object to store our data after the form submission
        $category = new Category();
        //prepare the form with the function createForm()
        $form=$this->createForm(CategoryType::class,$category);
        //extract the form answer from the received request
        $form->handleRequest($request);
        //if this form is valid
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirect($this->generateUrl(''));
        }
        return $this->render('@Offer/Category/create.html.twig',
            array(
                'form'=>$form->createView()
            ));
    }


    public function updateAction(Request $request, $id){
        //first step: //get the modele with $id with manager permission
        $em=$this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);
        //third step: // check is the from is sent
        if ($request->isMethod('POST')) {
            //update our object given the sent data in the request
            $category->setName($request->get('name'));
            $category->setDescription($request->get('description'));

            //fresh the data base
            $em->flush();
            //Redirect to the read
            return $this->redirectToRoute('Category_read');
            //second step: // send the view to the user

        }
        return $this->render('@Offer/Category/update.html.twig', array( 'category' => $category
        ));

    }


    public function deleteAction($id) {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $category= $em->getRepository(Category::class)->find($id);
        //remove from the ORM
        $em->remove($category);
        //update the data base
        $em->flush();
        return $this->redirectToRoute("Category_read");
    }

}
