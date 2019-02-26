<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    private $roomRepo;

    public function __construct(RoomRepository $roomRepo)
    {
        $this->roomRepo = $roomRepo;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $rooms = $this->roomRepo->findAll();
        return $this->render('/home/index.html.twig', [
            'rooms' => $rooms
        ]);
    }
}
