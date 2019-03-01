<?php

namespace App\Controller\Admin;

use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Room;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class AdminRoomController extends AbstractController
{
    private $em;
    private $roomRepo;
    private $paginator;

    public function __construct(
        ObjectManager $em, 
        RoomRepository $roomRepo, 
        PaginatorInterface $paginator
    ) {
        $this->em = $em;
        $this->roomRepo = $roomRepo;
        $this->paginator = $paginator;
    }
    /**
     * @Route(
     *     "/admin/room",
     *     name="admin_room"
     * )
     */
    public function index(Request $request): Response
    {
        $rooms = $this->paginator->paginate(
            $this->roomRepo->findAll(),
            $request->query->getInt('page', 1), 
            3
        );

        return $this->render('/admin/room/index.html.twig', [
            'rooms' => $rooms
        ]);
    }

    /**
     * @Route(
     *     "/admin/room/{id}",
     *     name="admin_persist_room",
     *     methods="PUT",
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
