<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Cards\Card;

class CardGameController extends AbstractController
{
    #[Route("/game/cards", name: "cards_start")]
    public function CardsHome(): Response
    {
        return $this->render('cards/CardsHome.html.twig');
    }

    #[Route("/game/cards/card", name: "draw_card")]
    public function drawCard(): Response
    {
        $card = new Card();

        $data = [
            "card" => $card->value,
            "cardString" => $card->asString(),
        ];

        return $this->render('cards/hand.html.twig', $data);
    }
}
