<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Proj\StorageHandler;
use App\Proj\RoomHandler;
use App\Proj\data\database\game_rooms;

final class ProjectController extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function index(): Response
    {
        // Set parameters

        $info = "You wake up in a strange room with a very, I mean VERY, strong urge to immediately escape.";
        $rules = "Use the arrow buttons to navigate, click to interact with objects";
        
        $data = [
            'info' => $info,
            'rules' => $rules
        ];

        return $this->render('proj/start_adventure.html.twig', $data);
    }

    #[Route('/project/room_one', name: 'room_one')]
    public function roomOne(): Response
    {
        $roomOne = RoomHandler::getRoomData("room_one");

        if (!$roomOne) {
            throw $this->createNotFoundException('Room not found');
        }

        $data = [
            'room' => $roomOne
        ];

        return $this->render('proj/room_one.html.twig', $data);
    }

    #[Route('/project/room_two', name: 'room_two')]
    public function roomTwo(): Response
    {
        $roomTwo = RoomHandler::getRoomData("room_two");

        $data = [
            'room' => $roomTwo
        ];

        return $this->render('proj/room_two.html.twig', $data);
    }

    #[Route('/project/room_three', name: 'room_three')]
    public function roomThree(): Response
    {
        $roomThree = RoomHandler::getRoomData("room_three");

        $data = [
            'room' => $roomThree
        ];

        return $this->render('proj/room_three.html.twig', $data);
    }

    #[Route('/project/room_four', name: 'room_four')]
    public function roomFour(): Response
    {
        $roomFour = RoomHandler::getRoomData("room_four");

        $data = [
            'room' => $roomFour
        ];

        return $this->render('proj/room_four.html.twig', $data);
    }

    #[Route('/project/deathtrap', name: 'deathtrap')]
    public function deathTrap(): Response
    {
        $deathTrap = [
            'name' => 'Game Over',
            'info' => 'Read the signs man..',
            'graphics' => [
                ['background' => 'deathtrap.png']
            ]
        ];

        $data = [
            'room' => $deathTrap
        ];

        return $this->render('proj/room_four.html.twig', $data);
    }

    #[Route('/project/move', name: 'move')]
    public function mover(Request $request): Response
    {
        // Get direction from input
        $direction = $request->request->get('direction');

        // Get currentRoomId
        $currentRoomId = $request->request->get('currentRoomId');
        
        // Move in found direction
        $result = RoomHandler::move($direction, $currentRoomId);
        
        dump(print_r($direction));
        error_log("Result: " . print_r($result, true));

        if ($result['success']) {
            // Redirect on succes
            return $this->redirectToRoute($result['redirect']);
        }
        else {
            return $this->redirectToRoute($currentRoomId);
        }
    }

    #[Route('/project/inventory', name: 'inventory')]
    public function inventory(Request $request): Response
    {
        // Select or deselect item on click
        // Also write the pair-value of the item for comparison with object clicked
        $item = $request->request->get('value');
        
        // Might not have to return this (could be used for popup with inv button nut better with open bar- few items)
        return $this->render('proj/inventory.html.twig');
    }
}
