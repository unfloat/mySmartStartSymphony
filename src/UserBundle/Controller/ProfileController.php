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

        parent::__construct($eventDispatcher, $formFactory, $userManager);

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

        if (in_array("ROLE_EMPLOYER", $user->getRoles())) {
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

        } elseif ((in_array("ROLE_FREELANCER", $user->getRoles()))) {
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

    ////////////////////////////////////////////////////////////////////////////////////
    ///
    ///


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function manage_projectAction()
    {
        $manage_project = $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('@Project/Employer/manage_project.html.twig', array('manage_project' => $manage_project));

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function manage_projectsAction(Request $request)
    {
        $manage_projects = $this->getDoctrine()->getRepository(Project::class)->findAll();

        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $manage_projects, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 4)/*limit per page*/
        );

        return $this->render('@Project/Employer/manage_projects.html.twig', ["manage_projects" => $result]);
    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function delete_manage_projectsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $manage_project = $em->getRepository(Project::class)->find($id);
        $em->remove($manage_project);
        $em->flush();
        return $this->redirectToRoute('list_manage_projects');

    }


    /**
     * @Security("has_role('ROLE_EMPLOYER')")
     */
    public function update_manage_projectsAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $manage_projects = $em->getRepository(Project::class)->find($id);
        $form = $this->createForm(ProjectType::class, $manage_projects);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($manage_projects);
            $em->flush();
            return $this->redirect($this->generateUrl('list_manage_projects'));
        }
        return $this->render('@Project/Employer/post_project.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectAction(Project $project)
    {
        $id_proj = $project->getId();
        $project = $this->getDoctrine()->getRepository(Project::class)->find(['id' => $id_proj]);
        return $this->render('@Project/Freelancer/singletask.html.twig', ["project" => $project]);

    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectsAction(Request $request, $sortBy = "projectName")
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $skills = $this->getDoctrine()->getRepository(Skills::class)->findAll();

        $projects = $this->getDoctrine()->getRepository(Project::class)->findBy(array(), array($sortBy => 'asc'));
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $projects, /* query NOT result */
            $request->query->getInt('page', 1), 4
        /*$request->query->getInt('limit', 4)/*limit per page*/
        );
        return $this->render('@Project/Freelancer/tasks.html.twig', array("projects" => $result, "categories" => $categories, "skills" => $skills));

    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function searchParametersAction(Request $request)
    {

        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $skills = $this->getDoctrine()->getRepository(Skills::class)->findAll();
        $projects = $this->getDoctrine()->getRepository(Project::class)
            ->findParameters($request->get("location"),
                $request->get("categories"),
                $request->get("skills"),
                $request->get("sortBy"));

        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $projects, /* query NOT result */
            $request->query->getInt('page', 1), 4
        /*$request->query->getInt('limit', 4)/*limit per page*/
        );
        return $this->render('@Project/Freelancer/tasks.html.twig', array("projects" => $result, "categories" => $categories, "skills" => $skills));

    }


    public function mailAction($address)
    {
        $message = (new \Swift_Message('Mail'))
            ->setFrom('foobar.esprit@gmail.com')
            ->setTo($address)
            ->setBody(
                $this->renderView(
                    '@Project/Freelancer/mail.html.twig', array(
                        'address' => $address,
                    )
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
        return new Response("Your email was sent successfully ");
    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function projectsListAction()
    {
        $projects = $this->getDoctrine()->getRepository(Project::class)->findAll();
        return $this->render('@Project/Freelancer/taskslist.html.twig', ["projects" => $projects]);

    }


    /**
     * @Security("has_role('ROLE_FREELANCER')")
     */
    public function singleProjectAction(Request $request, Project $project)
    {

        $em = $this->getDoctrine()->getManager();
        $bid = new Bid();
        $form = $this->createForm(BidType::class, $bid);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $bid->setProject($project);
            $em->persist($bid);
            $em->flush();
            return $this->redirectToRoute('freelancer_projects');
        }

        return $this->render('@Project/Freelancer/singletask.html.twig', ["project" => $project, "form" => $form->createView()]);

    }




}
