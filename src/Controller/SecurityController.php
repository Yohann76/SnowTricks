<?php

namespace App\Controller;

use App\Form\changePasswordForm;
use Symfony\Component\HttpFoundation\Request;
use App\Security\LoginFormAuthenticator;
use App\Form\resetForm;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\Model\UserRegistrationFormModel;
use App\Form\UserRegistrationType;
use Symfony\Component\Form\FormError;


class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('Will be intercepted before getting here');
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request,UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator)
    {
        $form = $this->createForm(UserRegistrationType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            
    
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $user->getPassword()
                
            ));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Si enregistrer,directement connecté en passant par formAuthenticator
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );

        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView()
        ]);
    }





    // Test Token mdp oublié #S
    /**
     *
     * @Route("/reset", name="reset")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return mixed
     * @throws \Exception
     */
    public function reset(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(resetForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            // Generer un token et associer le token a ce compte
            $token = bin2hex(random_bytes(13));
            $entityManager = $this->getDoctrine()->getManager();
            $repository = $this->getDoctrine()->getRepository(User::class);
            $user = $repository->findOneBy(array('email' => $form->get('Email')->getData())); // trouvé l'adresse mail POST du FORM
            $user->setToken($token);
            $entityManager->persist($user);
            $entityManager->flush();
            $mailtarget =  $form->get('Email')->getData();  // avoir l'email de l'utilisateur Formulaire //

            //  SSL
          //  $https['ssl']['verify_peer'] = FALSE;
          //  $https['ssl']['verify_peer_name'] = FALSE;

            $message = (new \Swift_Message('SnowTricks Message'))
                ->setFrom('yohanndurand76@gmail.com')
                ->setTo($mailtarget)
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/token.html.twig',
                        [
                            'token' => $token,
                            'user' => $user
                        ]
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);
            // fin mail
            $this->addFlash('info', "Email bien envoyé");
        }
        return $this->render('security/reset.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/token/{token}", name="resetNow")
     */
    public function resetNow(Request $request, UserPasswordEncoderInterface $encoder, $token)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $entityManager = $this->getDoctrine()->getManager();
        $user = $repository->findOneBytoken($token);
        $form = $this->createForm(changePasswordForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($user->getToken() === $token) {
                $password = $encoder->encodePassword($user, $form->get('plainPassword')->getData());
                $user->setPassword($password);
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    "Mot de passe modifié avec succès !"
                );
                return $this->redirectToRoute('login');
            }
            else
            {
                $this->addFlash(
                    'info',
                    "La modification du mot de passe a échoué ! Le lien de validation a expiré !"
                );
            }
        }
        return $this->render('security/changePassword.html.twig', [
            'changePasswordForm' => $form->createView(),
        ]);
    }
}
