<?php

namespace App\Controller\Admin;

use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Room;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    /**
     * @Route(
     *     "/admin/room/{id}",
     *     name="admin_persist_room",
     *     methods="{PUT}",
     *     requirements={"id": "\d+"}
     * )
     */
    public function persist(?Room $room): Response
    {
        if (null === $room) {
            $room = new Room();
        }

        return $this->render();
    }

    /**
     * @Route(
     *     "/admin/route/{id}",
     *     name="admin_delete_room",
     *     methods="DELETE",
     *     requirements={"id": "\d+"},
     *     options={"expose": true}
     * )
     */
    public function delete(Room $room)
    {
        $this->em->remove($room);
        $this->em->flush();
        return new JsonResponse('Room Deleted');
    }
}
