<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

class CardGameController extends AbstractController
{
    #[Route("/game/cards", name: "cards_start")]
    public function CardsHome(SessionInterface $session): Response
    {
        $deck = new DeckOfCards('Trad52');
        $hand = new CardHand($deck, 3);
        $card = $deck->dealCard();
        $sorted = $deck->sortDeck();
        $sorted = $sorted->asCards();
        $shuffled = $deck->shuffleDeck();
        $shuffled = $shuffled->asCards();
        $imgPath = "kmom02UML.svg";

        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $session->set('deck', $deck->getDeck());
        }

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
    public function drawCard($number): Response
    {   
        $number = (int) $number;
        $deck = new DeckOfCards('Trad52');
        $hand = new CardHand($deck, $number);
        $remainder = count($deck->getDeck());

        $data = [
            "hand" => $hand->asString(),
            "handGraph" => $hand->asCards(),
            "remainder" => $remainder,
        ];

        return $this->render('cards/drawSpec.html.twig', $data);
    }

    #[Route("/game/cards/deck/draw/{number}", name: "draw_amount")]
    public function drawAmount(int $number): Response
    {
        $deck = new DeckOfCards('Trad52');
        $hand = new CardHand(5, $deck);
        $card = $deck->de; // Also has to pop from deck!!?
        $remainder = count($deck->getDeck());

        $data = [
            "card" => $card->getValue(),
            "cardGraph" => $card->getGraphics(),
            "remainder" => $remainder,
        ];

        return $this->render('cards/drawAmount.html.twig', $data);
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
}
