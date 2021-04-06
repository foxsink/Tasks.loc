<?php


namespace App\Controller;


use App\Entity\User;
use App\Exception\ExpiredTokenException;
use App\Exception\UsedTokenException;
use App\Exception\UserNotFoundException;
use App\Form\Type\Security\LoginType;
use App\Form\Type\Security\RegisterType;
use App\Mailer\Mailer;
use App\RegisterToken\TokenGenerator;
use Exception;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(LoginType::class, null, [
            'btn-label' => 'Sign in!',
            'lastUsername' => $authenticationUtils->getLastUsername(),
            ]);
        $error = $authenticationUtils->getLastAuthenticationError();
        $this->addFlash('danger', $error ? $error->getMessage() : null);
        return $this->render('security/login.html.twig', [
            'form'     => $form->createView(),
        ]);

    }

    /**
     * @Route("/logout")
     */
    public function logout()
    {
        throw new LogicException("Try to logout");
    }

    /**
     * @Route("/register")
     * @param Request $request
     * @param TokenGenerator $tokenGenerator
     * @param Mailer $mail
     * @return Response
     * @throws Exception
     * @throws TransportExceptionInterface
     */
    public function register(Request $request, TokenGenerator $tokenGenerator, Mailer $mail): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute("app_index_index");
        }
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user,['btn-label' => 'Sign up!']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//            $user->setPassword($userPasswordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $token = $tokenGenerator->createToken($user);
            $entityManager->flush();
            $mail->sendVerifyEmail($user->getEmail(), $token);
            return $this->redirectToRoute('app_index_index');
        }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("token/{token}")
     * @param TokenGenerator $tokenGenerator
     * @param string|null $token
     * @return Response
     */
    public function tokenVerify(TokenGenerator $tokenGenerator, string $token): Response
    {
        $user = null;
        try {
            $user = $tokenGenerator->activateUserByToken($token);
            $this->addFlash('success',  $user->getUsername() . " verified!");
        } catch (ExpiredTokenException $exception) {
            $this->addFlash('danger', "Your token is expired. Please contact administrator");
        } catch (UsedTokenException $exception) {
            $this->addFlash('warning', "Your token is already used");
        } catch (UserNotFoundException $exception) {
            $this->addFlash('danger', $exception->getMessage());
        }
        return $this->redirectToRoute("app_security_login");

    }
}