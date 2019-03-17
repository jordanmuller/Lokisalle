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
use Symfony\Component\Serializer\SerializerInterface;

class AdminRoomController extends AbstractController
{
    private $em;
    private $roomRepo;
    private $paginator;
    private $serializer;

    public function __construct(
        ObjectManager $em,
        RoomRepository $roomRepo,
        PaginatorInterface $paginator,
        SerializerInterface $serializer
    ) {
        $this->em = $em;
        $this->roomRepo = $roomRepo;
        $this->paginator = $paginator;
        $this->serializer = $serializer;
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
     *     name="admin_room_get",
     *     methods="GET",
     *     requirements={"id": "\d+"},
     *     options={"expose": true}
     * )
     */
    public function getRoom(Room $room)
    {
        $json = $this->serializer->serialize($room, 'json', ['groups' => 'getRoom']);
        return new JsonResponse($json, 200);
    }

    /**
     * @Route(
     *     "/admin/room/{?id}",
     *     name="admin_room_persist",
     *     methods="PUT",
     *     requirements={"id": "\d+"},
     *     options={"expose": true}
     * )
     */
    public function persist(?Room $room): JsonResponse
    {
        if (null === $room) {
            $room = new Room;
        }

        if (null === $room->getId()) {
            $this->em->persist($room);
        }
        $this->em->flush();
        return new JsonResponse('Room persisted', 200);
        
        return new JsonResponse('Room Persisted failed', 400);
    }

    /**
     * @Route(
     *     "/admin/route/{id}",
     *     name="admin_room_delete",
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
