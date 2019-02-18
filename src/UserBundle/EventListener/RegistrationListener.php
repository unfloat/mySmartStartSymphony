<?php
/**
 * Created by PhpStorm.
 * User: olfa
 * Date: 17/02/19
 * Time: 06:10 م
 */

namespace UserBundle\EventListener;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class RegistrationListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public static function onRegistrationSuccess(FormEvent $event)
    {


        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();

        if ($event->getRequest()->get('account-type-radio') == "freelancer")
            $user->setRoles(['ROLE_FREELANCER']);
        else
            $user->setRoles(['ROLE_EMPLOYER']);


    }


}