<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Swift_Mailer;
//class RegistrationController extends AbstractController
class RegistrationController extends AbstractController
{

    private $urlGenerator;


    /**
     * @var Swift_Mailer
     */
    private $mailer;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository,  \Swift_Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $login = $this->urlGenerator->generate('login');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setUserType( $request->get('roles'));
            $user->setIsValid($request->get('isValid'));
            $user->setCreatedAt();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $message = (new \Swift_Message('Confirm Email'))
                ->setFrom('mubasharhussain428@gmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'email.html.twig',
                        [
                            'Name' => $user->getName(),
                            'visit' => $user->getEmail(),
                            'url' => getenv("SITE_BASE_URL")
                            ]
                    ),
                    'text/html'
                );

            $mailer->send($message);
            return $this->redirectToRoute('login');
        }
        return $this->render(
            'registration/index.html.twig',
            array('form' => $form->createView(), 'login'=> $login)
        );
    }

    /**
     * @Route("/resetthis", name="user_forget1", methods={"POST"})
     */
    public function forget(Request $request,  \Swift_Mailer $mailer): Response
    {
        $email = $request->get('email');
        $message = (new \Swift_Message('Forget'))
            ->setFrom('mubasharhussain428@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'forgetPassword.html.twig',
                    [
                        'visit' => $email,
                        'url' => getenv("SITE_BASE_URL")
                    ]
                ),
                'text/html'
            );

        $mailer->send($message);
        $this->addFlash('success', 'Please Check your email and follow this link');
        return $this->redirectToRoute('login');
    }

    /**
     * @Route("/", name="main_page", methods={"GET"})
     */
    public function index1(UserRepository $userRepository): Response
    {
        $this->addFlash('success', 'You Connected As');
        return $this->render('index.html.twig');

    }

    /**
     * @Route("/user/admin", name="admin_page", methods={"GET"})
     */
    public function admin(UserRepository $userRepository): Response
    {
        $this->addFlash('success', 'You Connected As');
        return $this->render('admin.html.twig');

    }

    /**
     * @Route("/users", name="userList", methods={"GET"})
     */
    public function userList(UserRepository $userRepository): Response
    {
        $this->addFlash('success', 'You Connected As');
        $student = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('student/index.html.twig', array('students' => $student));;
    }
    /**
     * @Route("/user/{id}/{status}", name="status_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $id =  $request->get('id');
        $status =  $request->get('status');
        $this->userRepository->changeStatus($id, $status);
        return $this->redirectToRoute('main_page');
    }

    /**
     * @Route("/us/{email}", name="user_confrim", methods={"GET"})
     */
    public function confirmEmail(Request $request): Response
    {
        $id =  $request->get('email');
        $this->userRepository->confirmEmail($id);
        $this->addFlash('success', 'Your Account is Active');
        return $this->redirectToRoute('main_page');
    }

    /**
     * @Route("/us/forget/{email}", name="user_forget", methods={"GET"})
     */
    public function forgetPassword(Request $request): Response
    {
        $id =  $request->get('email');
        $changePassword = $this->urlGenerator->generate('changePassword');
        return $this->render('forgetForm.html.twig',
        [ 'email' => $id, 'changePassword'=>$changePassword]);

    }

    /**
     * @Route("changePassword", name="changePassword", methods={"POST"})
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $id =  $request->get('email');
        $password =  $request->get('password');
        $user = new User();
        $password = $passwordEncoder->encodePassword($user, $password);
        $this->userRepository->changePassword($id, $password);
        return $this->redirectToRoute('login');
    }


}
