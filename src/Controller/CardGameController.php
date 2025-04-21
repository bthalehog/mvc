<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

class CardGameController extends AbstractController
{
    #[Route("/game/cards", name: "cards_start")]
    public function CardsHome(): Response
    {
        $deck = new DeckOfCards('Trad52');
        $hand = new CardHand($deck, 3);
        $card = new Card("s5");

        $data = [
            "deck" => $deck->asString(),
            "hand" => $hand->asString(),
            "card" => $card->getValue(),
        ];

        return $this->render('cards/CardsHome.html.twig', $data);
    }

    #[Route("/game/cards/card1", name: "draw_card")]
    public function drawCard1(): Response
    {
        $card = new Card("s2");

        $data = [
            "card" => $card->getValue(),
            "cardString" => $card->asString(),
        ];

        return $this->render('cards/card.html.twig', $data);
    }
}
