<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\Type\LoginType;
use App\Form\Type\RegisterType;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route ("/login")
     *
     * @param AuthenticationUtils $authenticationUtils
     *
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()){
           return $this->redirectToRoute("app_index_index");
        }

//        $form = $this->createForm(LoginType::class);
//        $form->handleRequest($request);

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
//            'form' => $form->createView(),
            'error'        => $error,
            'lastUsername' => $lastUsername,


        ]);

    }

    /**
     * @Route ("/logout")
     */
    public function logout()
    {
        throw new LogicException("WTF?");
    }

    /**
     * @Route ("/register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

//            $user->setPassword($userPasswordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_index_index');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}