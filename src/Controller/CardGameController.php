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
    public function cardsHome(SessionInterface $session): Response
    {
        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $session->set('deck', $deck);
            echo "No deck in session, rerouting...";
            return $this->redirectToRoute('session_start');
        }
        $deck = $session->get('deck', new DeckOfCards('Trad52'));
        echo "Loaded from session";

        $hand = new CardHand($deck, 3);
        // print_r($hand);
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

        $session->set('deck', $deck);

        return $this->render('cards/CardsHome.html.twig', $data);
    }

    #[Route("/game/cards/deck", name: "sort_deck")]
    public function sortDeck(SessionInterface $session): Response
    {
        // $deck = new DeckOfCards('Trad52');
        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $session->set('deck', $deck);
            echo "No deck in session, rerouting...";
            return $this->redirectToRoute('session_start');
        }

        $deck = $session->get('deck', new DeckOfCards('Trad52'));
        
        $deck = $deck->sortDeck();
        $data = [
            "deck" => $deck->asCards(),
        ];

        $session->set('deck', $deck);

        return $this->render('cards/deck.html.twig', $data);
    }

    #[Route("/game/cards/deck/draw/{number}", name: "draw_specific")]
    public function drawCard($number, SessionInterface $session): Response
    {
        // $deck = new DeckOfCards('Trad52');
        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $session->set('deck', $deck);
            echo "No deck in session, rerouting...";
            return $this->redirectToRoute('session_start');
        } 
        
        $deck = $session->get('deck', new DeckOfCards('Trad52'));
        

        $number = (int) $number;
        $hand = new CardHand($deck, $number);
        $remainder = count($deck->getDeck());

        $data = [
            "hand" => $hand->asString(),
            "handGraph" => $hand->asCards(),
            "remainder" => $remainder,
        ];

        $session->set('deck', $deck);

        return $this->render('cards/drawSpec.html.twig', $data);
    }

    #[Route("/game/cards/deck/draw/{number}", name: "draw_amount")]
    public function drawAmount(int $number, SessionInterface $session): Response
    {
        // $deck = new DeckOfCards('Trad52');
        // $deck = $session->get('deck', new DeckOfCards('Trad52'));
        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $session->set('deck', $deck);
            echo "No deck in session, rerouting...";
            return $this->redirectToRoute('session_start');
        }
        $deck = $session->get('deck', new DeckOfCards('Trad52'));
        
        // POKED AROUND HERE
        // $hand = new CardHand($number, $deck);
        $card = $deck->cardToHand($deck, $number); // Also has to pop from deck!!?
        $remainder = count($deck->getDeck());

        $data = [
            "card" => $card->getValue(),
            "cardGraph" => $card->getGraphics(),
            "remainder" => $remainder,
        ];

        $session->set('deck', $deck);

        return $this->render('cards/drawAmount.html.twig', $data);
    }

    #[Route("/game/cards/deck/shuffle", name: "shuffle_deck")]
    public function shuffleDeck(SessionInterface $session): Response
    {
        // $deck = $session->get('deck', new DeckOfCards('Trad52'));
        // $deck = new DeckOfCards('Trad52');
        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $session->set('deck', $deck);
            echo "No deck i session, rerouting...";
            return $this->redirectToRoute('session_start');
        }
        $deck = $session->get('deck', new DeckOfCards('Trad52'));
        
        $data = [
            "deck" => $deck->shuffleDeck(),
            "deckGraph" => $deck->asCards(),
        ];

        $session->set('deck', $deck);

        return $this->render('cards/shuffle.html.twig', $data);
    }
}
