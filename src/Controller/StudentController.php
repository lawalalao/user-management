<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\User;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student_index", methods={"GET"})
     */
    public function index(StudentRepository $studentRepository): Response
    {
        echo 'hello';
        die();
//        $student = $this->getDoctrine()->getRepository(Student::class)->findAll();
        $student = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('student/index.html.twig', array('students' => $student));
        return $this->render('student/index.html.twig', [
            'students' => $studentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="student_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $password = $_POST['password'];
            $class = $_POST['class'];
            $gendor = $_POST['gendor'];
            $marks = $_POST['marks'];
            $student->setEmail($_POST['email']);;
            $student->setName($_POST['name']);
            $student->setPassword($password);
            $student->setClass($class);
            $student->setMarks($marks);
            $student->setGendor($gendor);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods={"GET"})
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {

        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $class = $_POST['class'];
            $gendor = $_POST['gendor'];
            $marks = $_POST['marks'];
            $student->setEmail($email);;
            $student->setName($name);
            $student->setPassword($password);
            $student->setClass($class);
            $student->setMarks($marks);
            $student->setGendor($gendor);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
//            'data' => $data,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_index');
    }
}
