<?php

namespace PortfolioBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use PortfolioBundle\Entity\Portfolio;
use PortfolioBundle\Form\PortfolioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PortfolioController extends Controller
{





    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */


    public function editPortfolioAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $portfolio = $em->getRepository(Portfolio::class)->find($id);
        $form = $this->createForm(PortfolioType::class, $portfolio);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($portfolio);
            $em->flush();
            return $this->redirect($this->generateUrl('freelancer_dashboard'));
        }
        return $this->render('@PortfolioBundle\Resources\views\Freelancer\addPortfolio.html.twig', ['form' => $form->createView()]);
    }





}
