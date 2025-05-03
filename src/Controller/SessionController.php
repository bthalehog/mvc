<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Cards\TwentyOne;

class SessionController extends AbstractController
{
    #[Route("/session", name: "session_start")]
    public function sessionStart(SessionInterface $session): Response
    {
        if (!$session) {
            $deck = new DeckOfCards('Trad52');
            $game = null;
            $this->initSession($session, $deck, $game);
            echo "Session created";
        }

        if ($session == null) {
            $deck = new DeckOfCards('Trad52');
            $cardHand = new CardHand();
            $players = 0;
            $this->initSession($session, $deck, $cardHand, $players);
            echo "Session created";
        }

        if (!$session->has('game')) {
            $game = null;
            $session->set('game', $game);
            echo "Empty session created";
        }

        if ($session->has('game')) {
            $game = $session->get('game');
            echo "Game loaded from session";
        }

        if ($session->has('deck')) {
            $deck = $session->get('deck');
            echo "Deck loaded from session";
        }

        if (!$session->has('deck')) {
            $deck = new DeckOfCards('Trad52');
            $this->initSession($session, $deck);
            echo "Session created - ";
        }

        $sessionData = [
            "sessionData" => new JsonResponse($session->all()),
        ];

        return $this->render('cards/session.html.twig', $sessionData);
    }

    private function initSession(SessionInterface $session, $deck)
    {
        $session->set('deck', $deck->asCards());
        echo "New";
    }

    #[Route("/session/delete", name: "session_delete")]
    public function sessionDelete(SessionInterface $session): Response
    {
        if ($session != null) {
            $this->deleteSession($session);
        }

        if ($session == null) {
            echo "No session to destroy. Visit /session to initiate.";
        }

        return $this->render('cards/delsession.html.twig');
    }

    private function deleteSession(SessionInterface $session): void
    {
        $session->invalidate();
        // $session->clear();
        echo "Session DEL";
    }

    #[Route('/debug/session', name: 'debug_session')]
    public function debugSession(SessionInterface $session): Response
    {
        $data = $session->all();

        return new Response(
            '<pre>' . print_r($data, true) . '</pre>'
        );
    }
}
