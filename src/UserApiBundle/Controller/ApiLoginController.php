<?php

namespace UserApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class ApiLoginController extends Controller
{

    public function loginAction(Request $request)
    {
        $_username = $request->get('username');
        $_password = $request->get('password');

        // Retrieve the security encoder of symfony
        $factory = $this->get('security.encoder_factory');

        /// Start retrieve user
        // Let's retrieve the user by its username:
        // If you are using FOSUserBundle:
        $user_manager = $this->get('fos_user.user_manager');
        $user = $user_manager->findUserByUsername($_username);
        // Or by yourself
        //$user = $this->getDoctrine()->getManager()->getRepository(Utilisateur::class)
          //  ->findOneBy(array('username' => $_username));
        /// End Retrieve user

        // Check if the user exists !
        if(!$user){
            return new Response(
                'Username doesnt exists',
                Response::HTTP_UNAUTHORIZED
                //,array('Content-type' => 'application/json')
            );
        }

        /// Start verification
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();

        if(!$encoder->isPasswordValid($user->getPassword(), $_password, $salt)) {
            return new Response(
                'Username or Password not valid.',
                Response::HTTP_OK,
                array('Content-type' => 'application/json')
            );
        }
        /// End Verification

        // The password matches ! then proceed to set the user in session

        //Handle getting or creating the user entity likely with a posted form
        // The third parameter "main" can change according to the name of your firewall in security.yml
        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);

        // If the firewall name is not main, then the set value would be instead:
        // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
        $this->get('session')->set('_security_main', serialize($token));

        // Fire the login event manually
        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        /*
         * Now the user is authenticated !!!!
         * Do what you need to do now, like render a view, redirect to route etc.
         */
        return new Response(
            'Welcome '. $user->getUsername(),
            Response::HTTP_OK,
            array('Content-type' => 'application/json')
        );
    }
}
