<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

class MyControllerJson
{
    #[Route("/api")]
    public function jsonNumber(): Response
    {
        $number = random_int(0, 100);

        $data = [
            '/api' => 'This page',
            '/api/quote' => 'Libraries for quotes and pictures',
            '/api/deck' => 'Deck of Cards',
            '/api/deck/shuffle' => 'Shuffled deck',
            '/api/deck/draw' => 'Draw singular card',
            '/api/deck/draw/number' => 'Draw amount of cards',
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/quote')]
    public function quote(): Response
    {
        $quote = random_int(0, 4);
        $quoteslist = ['Håll ut kosack, en dag blir du hövding', 'Själv är bäste dräng', 'Rötterna blir starka när det blåser', 'Ingen rök utan eld', 'Tala är silver, tiga är guld'];
        $artlist = ['bwrepair', 'bwtakeoff', 'bwstruggle', 'bwtailgun', 'bwbrainscan'];
        $selected = $quoteslist[$quote];
        $picture = $artlist[$quote];
        $data = [
            'quote' => $selected,
            'library' => $quoteslist,
            'picture' => $picture,
            'gallery' => $artlist,
            'timestamp' => date('c'),
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/deck')]
    public function deck(SessionInterface $session): Response
    {
        $deck = new DeckOfCards('Trad52');
        $data = [
            'deck' => $deck->asCards(),
            'timestamp' => date('c'),
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/deck/shuffle')]
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new DeckOfCards('Trad52');
        $deck->shuffleDeck();
        $data = [
            'deck' => $deck->asCards(),
            'timestamp' => date('c'),
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/deck/draw')]
    public function draw1(SessionInterface $session): Response
    {
        $deck = new DeckOfCards('Trad52');
        $card = $deck->dealCard();
        $data = [
            'card' => $card->getGraphics(),
            'timestamp' => date('c'),
        ];

        return new JsonResponse($data);
    }

    #[Route('/api/deck/draw/{number}')] //has to be frontend if :number not just treated as string.
    public function draw($number, SessionInterface $session): Response
    {
        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $session->set('deck', $deck);
            // echo "No deck in session, rerouting...";
        } else {
            $deck = $session->get('deck', new DeckOfCards('Trad52'));
            // echo "Loaded from session";
        }

        // $deck = new DeckOfCards('Trad52');
        $hand = new CardHand($deck, $number);
        $remainder = count($deck->getDeck());
        $data = [
            'hand' => $hand->asCards(),
            'timestamp' => date('c'),
            'remainder' => $remainder,
        ];

        return new JsonResponse($data);
    }
}
