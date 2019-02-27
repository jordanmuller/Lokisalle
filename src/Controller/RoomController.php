<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Room;

class RoomController extends AbstractController
{
    /**
     * @Route(
     *     "/room/{id}",
     *     name="room_show",
     *     requirements={"id": "\d+"}
     * )
     */
    public function show(Room $room)
    {
        $avg = $room->getAvgMarks();
        return $this->render('room/show.html.twig',
            ['room' => $room]
        );
    }
}
