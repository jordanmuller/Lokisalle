<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashBoardController extends AbstractController
{
    /**
     * @Route(
     *     "/admin",
     *     name="admin_dashboard"
     * )
     */
    public function index(): Response
    {
        return $this->render('/admin/index.html.twig');
    }
}
