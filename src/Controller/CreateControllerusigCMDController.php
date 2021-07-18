<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateControllerusigCMDController extends AbstractController
{
    /**
     * @Route("/create/controllerusig/c/m/d", name="create_controllerusig_c_m_d")
     */
    public function index(): Response
    {
        return $this->render('create_controllerusig_cmd/index.html.twig', [
            'controller_name' => 'CreateControllerusigCMDController',
        ]);
    }
}
