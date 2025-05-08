<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Cards;
use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Cards\TwentyOne;

class TwentyOneController extends AbstractController
{
    #[Route("/game/doc", name: "doc")]
    public function getDoc()
    {
        $textArticle = "";
        $imgPath = "kmom03flowchart.svg";

        $data = [
            "article" => $textArticle,
            "imgPath" => $imgPath,
        ];

        return $this->render('cardgame/documentation.html.twig', $data);
    }

    #[Route("/game/twentyone", name: "twentyone")]
    public function twentyOne(Request $request, SessionInterface $session)
    {
        if ($session->get('game') === null) {
            // Can be a function
            $rules = TwentyOne::getRules();

            // Variables
            $deck = null;
            $game = null;

            // Get form-data
            $numberOfPlayersInput = $request->request->get('numberOfPlayers');
            $difficultyInput = $request->request->get('difficulty');

            if ($request->isMethod('POST') && $numberOfPlayersInput !== null && $difficultyInput !== null) {
                // Write constants to session
                $session->set('difficulty', $difficultyInput);
                $session->set('player_amount', $numberOfPlayersInput);

                // Possibility to augment for multiple deck types depending on difficulty.
                $deck = new DeckOfCards('Trad52');

                // Create game from input
                $game = new TwentyOne($deck, $numberOfPlayersInput, $difficultyInput);

                // This removes bank from player array and sets stake to $50.
                $game->setBank($game->getPlayer(0));
                $game->setStake(50);

                // Allowing for index pos 0 to be used again to initiate queue
                $game->setCurrentPlayer($game->getPlayer(0));

                // Set player index for queue-handler.
                $game->setCurrentPlayerIndex(0);

                // Write to session
                $session->set('deck', $deck);
                $session->set('game', $game);
                $session->set('bank', $game->getBank());
                $session->set('player', $game->getCurrentPlayer());
                $session->set('stake', 50);
                $session->set('playerIndex', $game->getCurrentPlayerIndex());

                return $this->redirectToRoute('play');
            }

            // Set html
            $difficulty = '<label for="difficulty">Select difficulty</label><br><select id="difficulty" name="difficulty" value=""><option value="normal">Normal</option><option value="nightmare">Nightmare</option></select><br>';
            $players = '<label for="numberOfPlayers">Number of players</label><br><input id="numberOfPlayers" name="numberOfPlayers" type="number" value="" /><br>';
            $button = '<button type="submit" class="cardGameButton">Start game!</button>';

            // Store and send to render startpage
            $data = [
                "rules" => $rules,
                "difficulty" => $difficulty,
                "players" => $players,
                "button" => $button
            ];

            return $this->render('cardgame/cardgame.html.twig', $data);
        }
        return $this->redirectToRoute('play');
    }

    #[Route("/game/twentyone/play", name: "play")]
    public function start(SessionInterface $session, Request $request): Response
    {
        $this->addFlash('notice', 'Game started!');
        
        $game = $session->get('game');
        $bank = $session->get('bank');
        $player = $session->get('player');
        // $playerIndex = $session->get('playerIndex'); // Added for turn handle

        // Template variables
        $gameInfo = "";
        $winner = "";
        
        // $result = "";
        $action = "";
        
        // HTML-buttons
        $button1 = '<button type="submit" id="playerButtonDraw" name="action" class="playerButton" value="draw">Draw card</button>';
        $button2 = '<button type="submit" id="playerButtonStay" name="action" class="playerButton" value="stay">Stay</button>';
        $button3 = '<button type="submit" id="newGameBtn" name="action" class="playerButton" value="new">New game</button>';
        $button4 = '<button type="submit" id="nextPlayerBtn" name="action" class="playerButton" value="next">Next player</button>';
        
        // Get player input for trigger behaviour.
        if ($request->isMethod('POST')) {
            $action = $request->request->get('action');
        }
        // Start collection of echoes for gameinfo
        ob_start();
        
        // New game by reroute to session delete
        if ($action === "new") {
            return $this->redirectToRoute('session_delete');
        } elseif ($action === "next") {
            if ($game->lastPlayer() === true) {
                // Announce winner
                $gameInfo .= (string)$winner . "wins!";
                // Clear views
                $game->getBank()->discardHand();
                $game->getCurrentPlayer()->discardHand();
                // Save to session
                $session->set('game', $game);
                $session->set('player', $game->getCurrentPlayer());
                $session->set('bank', $game->getBank());
                $gameInfo .= "Hit new game-button to reset session and start a new game.";
                sleep(5);
                return $this->redirectToRoute('session_delete');
            }
            // Clear views
            $game->getCurrentPlayer()->discardHand();
            $game->getBank()->discardHand();
            // Save to session
            $session->set('game', $game);
            $session->set('player', $game->getCurrentPlayer());
            $session->set('bank', $game->getBank());
            // Bring out next player (also increments currentPlayerIndex and assigns new currentPlayer)
            $game->nextPlayer();
            $this->addFlash('notice', "Player" . (string)$game->getCurrentPlayer()->getPlayer() . "takes turn..");
            // Save to session
            $session->set('game', $game);
            $session->set('player', $game->getCurrentPlayer());
            $session->set('bank', $game->getBank());
            $session->set('playerIndex', $game->getCurrentPlayerIndex());
            
        } elseif ($action === "draw") {
            $game->getCurrentPlayer()->cardToHand(1, $game->getDeck());
            if ($game->getCurrentPlayer()->getHandValue() > 21) {
                if ($game->is21($game->getCurrentPlayer()->getHand()) === true) {
                    $game->getCurrentPlayer()->setStatus("happy");
                    $gameInfo .= "Player " . (string)$game->getCurrentPlayer()->getPlayer() . " hits 21! Stays.";
                } elseif ($game->getCurrentPlayer()->getHandValue() === 21) {
                    $game->getCurrentPlayer()->setStatus("happy");
                    $gameInfo .= "Player" . $game->getCurrentPlayer()->getPlayer() . " hits 21!";
                } 
                $game->getCurrentPlayer()->setStatus("fat");
                $game->getBank()->setStatus("winner");
                $gameInfo .= "Player" . (string)$game->getCurrentPlayer()->getPlayer() . " burst!";
            }
            // Save to session
            $session->set('game', $game);
            $session->set('bank', $game->getBank());
            $session->set('player', $game->getCurrentPlayer());
        } if ($action === "stay" or $game->getCurrentPlayer()->getStatus() === "fat" or $game->getCurrentPlayer()->getStatus() === "happy") {
            // Banks turn, decide for engine.
            // SINGLE PLAYER ENGINE - BANK LOGIC AI
            if ($game->playerCount() <= 2) {
                $gameInfo .= "Bank AI takes turn, draws 2...";
                // Auto pull to 17 for both engine types.
                $game->autoPull();
                // Save to session
                $session->set('game', $game);
                $session->set('bank', $bank);
                $session->set('player', $player);
                sleep(1);
                // Automatic bank move
                $game->bankMoveAI();
                sleep(1);
                // Save to session
                $session->set('game', $game);
                $session->set('player', $game->getCurrentPlayer());
                $session->set('bank', $game->getBank());
            }
            // MULTIPLAYER ENGINE - USER INPUT BANK LOGIC
            elseif ($game->playerCount() > 2) {
                $this->addFlash('notice', "Bank takes turn, draws 2...");
                $game->autoPull();
                // Save to session
                $session->set('game', $game);
                $session->set('bank', $game->getBank());
                $session->set('player', $game->getCurrentPlayer());
                sleep(1);

                $action = $request->request->get('action');
                if ($action === "draw") {
                    $game->bankMove($action);
                }
                // Save to session
                $session->set('game', $game);
                $session->set('bank', $game->getBank());
                $session->set('player', $game->getCurrentPlayer());
                $game->compareHands($game->getBank(), $game->getCurrentPlayer());
            }
            echo "Finding winner...";
            sleep(1);
            // Determine winner by sorting on status, player can never be winner at this stage only happy. (has function in game)
            $winner = $game->determineWinner();
            $gameInfo .= "Winner: " . $winner;
            $session->set('game', $game);
            $session->set('bank', $game->getBank());
            $session->set('player', $game->getCurrentPlayer());
        }

        // Collect and clean up echoes
        $output = ob_get_clean();

        // Set data-variables for rendering. (Write $layer and $bank into session)
        $data = [
            "button1" => $button1,
            "button2" => $button2,
            "button3" => $button3,
            "button4" => $button4,
            "gameInfo" => $gameInfo,
            "output" => $output,
            "player" => $game->getCurrentPlayer()->asCards(),
            "bank" => $game->getBank()->asCards(),
            "winner" => $winner,
        ];
        return $this->render('cardgame/play.html.twig', $data);
    }
}
