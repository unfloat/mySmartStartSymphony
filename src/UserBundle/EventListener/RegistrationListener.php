<?php
/**
 * Created by PhpStorm.
 * User: olfa
 * Date: 17/02/19
 * Time: 06:10 م
 */

namespace UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class RegistrationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $arrayRoles = array('ROLE_USER');


        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();

            $user->setRoles($arrayRoles);

    }



}