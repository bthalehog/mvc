<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function index(): Response
    {
        $info = "You wake up in a strange room with a very, I mean VERY, strong urge to immediately escape.";
        $rules = "Use the arrow buttons to navigate, click to interact with objects";
        
        $data = [
            'info' => $info,
            'rules' => $rules
        ];

        return $this->render('proj/proj.html.twig', $data);
    }

    #[Route('/project/room_one', name: 'room_one')]
    public function roomOne(): Response
    {
        $data = $this->getRoomOne();

        return $this->render('proj/room_one.html.twig', $data);
    }

    #[Route('/project/room_two', name: 'room_two')]
    public function roomTwo(): Response
    {
        $data = $this->getRoomTwo();

        return $this->render('proj/room_two.html.twig', $data);
    }

    #[Route('/project/room_three', name: 'room_three')]
    public function roomThree(): Response
    {
        $data = $this->getRoomThree();

        return $this->render('proj/room_three.html.twig', $data);
    }

    #[Route('/project/room_three', name: 'room_three')]
    public function roomFour(): Response
    {
        $data = $this->getRoomFour();

        return $this->render('proj/room_four.html.twig', $data);
    }

    #[Route('/project/move/{direction}', name: 'move')]
    public function move($direction): Response
    {
        $game = $this->getGame();

        // Need to find room among rooms by id then match exits to arg direction.
        // How to make it redirect to route if ok?
        
        return $this->render('proj/room_four.html.twig', $data);
    }


}
