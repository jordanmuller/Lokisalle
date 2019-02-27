<?php

namespace App\Controller\Admin;

use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

class AdminRoomController extends AbstractController
{
    private $em;
    private $roomRepo;

    public function __construct(ObjectManager $em, RoomRepository $roomRepo)
    {
        $this->em = $em;
        $this->roomRepo = $roomRepo;
    }
    /**
     * @Route(
     *     "/admin/room",
     *     name="admin_room"
     * )
     */
    public function index(): Response
    {
        $rooms = $this->roomRepo->findAll();
        return $this->render('/admin/room/index.html.twig', [
            'rooms' => $rooms
        ]);
    }
}
