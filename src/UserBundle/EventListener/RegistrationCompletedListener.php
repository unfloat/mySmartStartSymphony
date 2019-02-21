<?php
/**
 * Created by PhpStorm.
 * User: olfa
 * Date: 17/02/19
 * Time: 06:10 م
 */

namespace UserBundle\EventListener;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class RegistrationCompletedListener implements EventSubscriberInterface
{
    private $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationConfirm',
        );
    }


    public function onRegistrationConfirm(FilterUserResponseEvent $event)
    {

        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getUser();

        $response = $event->getResponse();


        if (in_array("ROLE_EMPLOYER", $user->getRoles()))
        {
            /** @var RedirectResponse $response */
            $response->setTargetUrl($this->router->generate('employer_dashboard'));
        }
        else if(in_array("ROLE_FREELANCER", $user->getRoles())){
            /** @var RedirectResponse $response */
            $response->setTargetUrl($this->router->generate('freealancer_dashboard'));
        }





         //   $event->setResponse(new RedirectResponse($url));
    }


}