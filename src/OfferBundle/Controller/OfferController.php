<?php

namespace OfferBundle\Controller;


use OfferBundle\Entity\Offer;
use OfferBundle\Entity\Skills;
use OfferBundle\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Freelancer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;




class OfferController extends Controller

{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function createAction(Request $request)
    {
        $offer = new Offer();
        if($request->getMethod()=="POST")
        {
            $name=$request->get('name');
            $salaryMin=$request->get('salaireMin');
            $salaryMax=$request->get('salaireMax');
            $type=$request->get('Type');
            $description=$request->get('description');
            $location=$request->get('location');
            $freealncer = $this->getDoctrine()->getManager()->getRepository(Freelancer::class)->find(5);
                $offer->setName($name);
                $offer->setPriceMin($salaryMin);
                $offer->setPriceMax($salaryMax);
            $offer->setType($type);
                $offer->setDescription($description);
                $offer->setFreelancer($freealncer);
                $offer->setLocation($location);


            $em=$this->getDoctrine()->getManager();
                $em->persist($offer);
                $em->flush();
                //$this->sendNotification($request,$offer);
        }
        return $this->render('@Offer/Offer/Offer.html.twig');
    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function listOffersAction(Request $request)
    {

        $waitingOffers=$this->getDoctrine()->getRepository(Offer::class)->findWaitingOffers();
        $nbr=count($waitingOffers);

        $em    = $this->get('doctrine.orm.entity_manager');
        if($request->getMethod()=="POST")
        {
            $offerName=$request->get('SearchName');
            $dql   = "SELECT o FROM OfferBundle:Offer o where o.name  like :key ";
            $query = $em->createQuery($dql)->setParameter('key', '%'.$offerName.'%');

        }
        else{
            $dql   = "SELECT o FROM OfferBundle:Offer o  WHERE o.status='En Attente'";
            $query = $em->createQuery($dql);
        }


        //$listOffers = $query->getResult();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('@Offer/Offer/listOffers.html.twig',array(
            'offers'=>$pagination,
            'waitingOffers'=>$nbr));
    }



    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    public function deleteOfferAction($id) {
        //get the object to be removed given the submitted id
        $em = $this->getDoctrine()->getManager();
        $offer= $em->getRepository(Offer::class)->find($id);
        //remove from the ORM
        $em->remove($offer);
        //update the data base
        $em->flush();
        return $this->redirectToRoute("offer_list");
    }


   // public function sendNotification(Request $request,Offre $offre)
    //{

      //  $manager = $this->get('mgilet.notification');
        //$notif = $manager->createNotification('A new offer has been added!');
        //$notif->setMessage('aaaa');
        //$notif->setLink($offre->getId());
        // or the one-line method :
        // $manager->createNotification('Notification subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        //$manager->addNotification(array($this->getUser()), $notif, true);

        //return $this->redirectToRoute('offer_Employer');
    //}


}
