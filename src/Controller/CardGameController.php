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
        $sorted = $deck->sortDeck();
        $sorted = $sorted->asCards();
        $shuffled = $deck->shuffleDeck();
        $shuffled = $shuffled->asCards();
        $imgPath = "kmom02UML.svg";

        $data = [
            "deck" => $deck->asCards(),
            "hand" => $hand->asCards(),
            "card" => $card->getGraphics(),
            "sorted" => $sorted,
            "shuffled" => $shuffled,
            "imgPath" => $imgPath,
        ];

        return $this->render('cards/CardsHome.html.twig', $data);
    }

    #[Route("/game/cards/deck", name: "sort_deck")]
    public function sortDeck(): Response
    {
        $deck = new DeckOfCards('Trad52');
        $deck = $deck->sortDeck();

        $data = [
            "deck" => $deck->asCards(),
        ];

        return $this->render('cards/deck.html.twig', $data);
    }

    #[Route("/game/cards/deck/draw/{number}", name: "draw_specific")]
    public function drawCard(int $number): Response
    {
        $deck = new DeckOfCards('Trad52');
        $card = $deck->findByOrder($number);

        $data = [
            "card" => $card->getValue(),
            "cardGraph" => $card->getGraphics(),
        ];

        return $this->render('cards/draw.html.twig', $data);
    }

    #[Route("/game/cards/deck/shuffle", name: "shuffle_deck")]
    public function shuffleDeck(): Response
    {
        $deck = new DeckOfCards('Trad52');
        $data = [
            "deck" => $deck->shuffleDeck(),
            "deckGraph" => $deck->asCards(),
        ];

        return $this->render('cards/shuffle.html.twig', $data);
    }

    #[Route("/game/session", name: "session_start")]
    public function sessionStart(): Response
    {
        // Need check for session and activation if not.

        $data = [
            "deck" => $deck->asCards(),
            "hand" => $hand->asCards(),
            "card" => $card->getGraphics(),
            "sorted" => $sorted,
            "shuffled" => $shuffled,
            "imgPath" => $imgPath,
        ];

        return $this->render('cards/CardsHome.html.twig', $data);
    }
}
