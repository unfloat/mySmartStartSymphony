<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use UserBundle\Entity\Freelancer;
use UserBundle\Form\FreelancerType;
use FOS\UserBundle\Model\UserManagerInterface;



class ProfileController extends BaseController
{

    private $eventDispatcher;
    private $formFactory;
    private $userManager;

    public function __construct(EventDispatcherInterface $eventDispatcher, FactoryInterface $formFactory, UserManagerInterface $userManager)
    {

        parent::__construct($eventDispatcher,$formFactory,$userManager);

    }

    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */

    /**
     * Show the employer profile.
     */
    public function showEmployerProfileAction()
    {
        $user = $this->getUser();

            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }

            return $this->render('@FOSUser/Profile/show.html.twig', array(
                'user' => $user,
            ));
    }

    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */

    /**
     * Show the freelancer profile.
     */
    public function showFreelancerProfileAction()
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('@FOSUser/Profile/show.html.twig', array(
            'user' => $user,
        ));
    }
    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if (in_array("ROLE_EMPLOYER", $user->getRoles()))
        {
            $form = $this->formFactory->createForm();
            $form->setData($user);
            $em = $this->getDoctrine()->getManager();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $event = new FormEvent($form, $request);
                $em->flush();
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                //$this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }


            return $this->render('@User/Profile/Employer/edit_employer.html.twig', array(
                'form' => $form->createView(),
            ));

        }
        elseif ((in_array("ROLE_FREELANCER", $user->getRoles())))
        {
            $form = $this->formFactory->createForm();
            $form->setData($user);
            $em = $this->getDoctrine()->getManager();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $event = new FormEvent($form, $request);
                $em->flush();
                if (null === $response = $event->getResponse()) {
                    $url = $this->generateUrl('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                //$this->eventDispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }


            return $this->render('@User/Profile/Freelancer/edit_freelancer.html.twig', array(
                'form' => $form->createView(),
            ));

        }





    }

}
