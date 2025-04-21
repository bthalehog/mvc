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
        $card = $deck->dealCard();
        
        $data = [
            "deck" => $deck->asCards(),
            "hand" => $hand->asCards(),
            "card" => $card->getGraphics(),
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
