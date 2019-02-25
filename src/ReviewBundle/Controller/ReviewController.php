<?php

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Review;
use ReviewBundle\Form\ReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\BrowserKit\Request;


class ReviewController extends Controller
{
    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function rateFreelancerAction()
    {
        $review=$this->getDoctrine()->getRepository(Review::class)->findAll();
        return $this->render('ReviewBundle:Review:affiche_Review.html.twig', array('review'=>$review));
    }

    public function afficheReviewAction()
    {
        $review=$this->getDoctrine()->getRepository(Review::class)->findAll();
        return $this->render('ReviewBundle:Review:affiche_Review.html.twig', array('review'=>$review));
    }

    public function addReviewAction(Request $request)
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class,$review);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
            return $this->redirectToRoute('affiche_Review');
        }
        return $this->render('ReviewBundle:Review:reviewForm.html.twig', ['form' => $form->createView()]);

    }

    public function deleteReviewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $review=$em->getRepository(Review::class)->find($id);
        $em->remove($review);
        $em->flush();
        return $this->redirectToRoute('affiche_Review');
    }

    public function updateReviewAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $review=$em->getRepository(Review::class)->find($id);
        $form = $this->createForm(ReviewType::class,$review);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();
            return $this->redirect($this->generateUrl('affiche_Review'));
        }
        return $this->render('ReviewBundle:Review:reviewForm.html.twig',['form'=>$form->createView()]);
    }


    public function rateEmployerAction()
    {
        $reviews=$this->getDoctrine()->getRepository(ReviewEmp::class)->findAll();
        return $this->render('ReviewBundle:Review:rate_employer.html.twig', array('reviewEmp'=>$reviews));
    }

    public function addReviewEmpAction(Request $request)
    {
        $reviews = new ReviewEmp();
        $form = $this->createForm(ReviewEmpType::class,$reviews);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reviews);
            $em->flush();
            return $this->redirectToRoute('rate_employer');
        }
        return $this->render('ReviewBundle:Review:reviewFormEmp.html.twig', ['form' => $form->createView()]);

    }

    public function deleteReviewEmpAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $reviews=$em->getRepository(ReviewEmp::class)->find($id);
        $em->remove($reviews);
        $em->flush();
        return $this->redirectToRoute('rate_employer');
    }

    public function updateReviewEmpAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $reviews=$em->getRepository(ReviewEmp::class)->find($id);
        $form = $this->createForm(ReviewEmpType::class,$reviews);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($reviews);
            $em->flush();
            return $this->redirect($this->generateUrl('rate_employer'));
        }
        return $this->render('ReviewBundle:Review:reviewFormEmp.html.twig',['form'=>$form->createView()]);
    }


}
