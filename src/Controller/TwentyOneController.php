<?php

namespace App\Controller;

/*

FLOWCHART to implement

game = new Game(); 	// Create game
sessionHandler(game); 	// Init and write to session
game.selectDifficulty(); 	// Select difficulty (normal/hell)
game.addPlayer(); 	// Add players to game


game.bankRotator(); 	// Select bank from players, if none then bank is computer.

WHILE (game.bank.status !== "happy" && game.player[x].status !== happy)
game.setStake(); 	// Bank sets stake
game.turn(); (++); 		// Current player selected from queue
game.playerMove(); 		// Current player makes move
game.bank.hand.is21(); 	// Check all players and bank result
game.player.hand.is21(); 	// Check all players and bank result
game.bank.specialCase(); 	// Check forspecialCase
game.player.specialCase(); 	// Check for specialCase
bank.isHappy(); 		// Check if bank happy
IF bank.isHappy() THEN
game.compareHands(game.bank, game.player);
IF player.isHappy() THEN
game.bankDraw()

IF (no one is happy and) deck empty THEN
game.compareHands(game.bank, game.player);	
IF game.bank > game.player THEN
game.bank.status = winner
ELSE
game.player.status = winner
		
game.payUp();		// Pay out stake to winner
destroySession();		// Destroy session
*/

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
        if ($session === null) {
            return redirectToRoute('session_start');
        }
        if ($session->get('game') === null) {
            $rules = '<article class="rules">
                <h2>Tjugo-ett</h2>
                    <ul>
                        <p>Spelets idé är att med två eller flera kort försöka uppnå det sammanlagda värdet 21, eller komma så nära som möjligt utan att överskrida 21.</p>
                        <li>Essen är värda valfritt 1 eller 14, kungarna 13, damerna 12, knektarna 11.</li>
                        <li>Nummerkorten har samma värden som valören.</li>
                        <li>En av deltagarna utses till bankir.</li>
                        <li>Bankiren i tjugoett spelar mot en spelare i taget.</li>
                        <li>Eftersom oddsen väger över till bankens fördel, är det brukligt att deltagarna turas om med att vara bankir.</li>
                    </ul>
                <h4>Specialfall</h4>
                    <ul>
                        <p><i>Tillämpas tillsammans med smartare AI vid "nightmare"-difficulty.</i></p>
                        <li>Två, eller tre, ess utan andra kort får räknas som 21</li>
                        <li>En spelare som fått fem kort utan att spricka anses ha uppnått 21</li>
                    </ul>
            </article>';

            $deck = null;
            $game = null;

            // Get form-data
            $numberOfPlayersInput = $request->request->get('numberOfPlayers');
            $difficultyInput = $request->request->get('difficulty');

            if ($request->isMethod('POST') && $numberOfPlayersInput !== null && $difficultyInput !== null) {    
                // Init object
                $deck = new DeckOfCards('Trad52');
                
                // Create game from input and write to session (seem to be neede to serialize correctly)
                $deck = new DeckOfCards('Trad52');
                $cardHand = new CardHand($deck);
                $session->set('deck', $deck);
                $cardHand = new CardHand($deck);
                $session->set('cardHand', $cardHand);
                $session->set('difficulty', $difficultyInput);

                $game = new TwentyOne($deck, $numberOfPlayersInput, $difficultyInput);
                $session->set('game', $game);
                
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
    public function start(SessionInterface $session, Request $request)
    {   
        $deck = $session->get('deck');
        $cardHand = $session->get('cardHand');
        $card = $session->get('card');
        $difficulty = $session->get('difficulty');
        $game = $session->get('game');

        $button1 = '<button type="submit" id="playerButtonDraw" name="action" class="playerButton" value="draw">Draw card</button>';
        $button2 = '<button type="submit" id="playerButtonStay" name="action" class="playerButton" value="stay">Stay</button>';
        $gameInfo = "";
        $winner = "";

        ob_start();

        if ($game->getCurrentPlayer() === null) {
            $game->turn();
        }
        
        // $game->turn();
        $currentPlayer = $game->getCurrentPlayer();
        $game->setBank();
        $game->setStake(50);
        $bank = $game->getBank();
        
        dump($game);

        // echo get_class($game);
        // echo get_class($game->getPlayer(0));
        // $currentPlayer = $game->getCurrentPlayer();
        // echo get_class($currentPlayer);

        // STD-CLASS -- CardHand
        echo get_class($bank);

        if (!$bank instanceof CardHand) {
            throw new \RuntimeException("Bank object not found or invalid.");
        }

        // Get player input
        $action = $request->request->get('action');

        if ($action === "draw") {
            $game->getCurrentPlayer()->cardToHand(1, $game->getDeck());
            
            if ($game->getCurrentPlayer()->getHandValue() > 21) {
                $game->getCurrentPlayer()->setStatus("fat");
                $game->getBank()->setStatus("winner");

            } else if ($game->getCurrentPlayer()->getHandValue() === 21) {
                $game->getCurrentPlayer()->setStatus("happy");
            }
        }

        if ($action === "stay") {
            $game->getCurrentPlayer()->setStatus("happy");

            // Initiate bank turn
            while ($game->getBank()->getHandValue() <= 17) {
                echo "Bank below 17, has to draw!";
                $game->getBank()->cardToHand(1, $game->getDeck());
            }

            while ($game->getBank()->getHandValue() < 21 && $game->getBank()->getStatus() !== "happy" && $game->getBank()->getStatus() !== "winner") {
                // This is used to set difficulty level or intelligence, mathematically always intelligent to stay above 17.
                if ($game->getBank()->getHandValue() > 17) {
                    $game->getBank()->setStatus("happy");
                    echo "Bank stays!";
                }

                if ($game->getBank()->getHandValue() > 21) {
                    // Check for 21-combinations.
                    if ($game->getBank()->is21()) {
                        $game->getBank()->setStatus("winner");
                        echo "Bank hits 21!";
                        // $game->getBank()->setScore(21);
                    }

                    $game->getBank()->setStatus("fat");
                    $game->getCurrentPlayer()->setStatus("winner");

                    echo "Bank is fat!";
                }

                if ($game->getBank()->getHandValue() === 21) {
                    $game->getBank()->setStatus("winner");
                    echo "Bank hits 21!";
                }

                $game->getBank()->cardToHand(1, $game->getDeck());
            }
        }

        if ($game->getBank()->getStatus() === "winner") {
            $winner = $game->getBank()->getPlayer();
        }

        /*
        // while ($game->getBank()->getStatus() !== "happy" || $game->getCurrentPlayer()->getStatus() !== "happy") {
            // Draw card
            $game->getCurrentPlayer()->cardToHand(1, $game->getDeck());

            // Check for lard
            if($game->getCurrentPlayer()->getHandValue() > 21) {
                $game->getCurrentPlayer()->setStatus("fat");
                $game->getBank()->setStatus("winner");
                break;
            }

            // Check for 21
            if($game->getCurrentPlayer()->getHandValue() === 21) {
                $game->getCurrentPlayer()->setStatus("happy");
            }

            // If not lardy and not 21 - OPTION connected to button
            // HERE HERE HERE
        }
            */

        /* TO BE IMPLEMENTED WHEN PLAYER LOGIC IS COMPLETE
        // BANK LOGIC (need new function, return playerHandValueTotal (use compareHands) in twentyOne)
        while ($game->getBank()->getStatus() !== "happy" && $game->getBank()->getStatus() !== "fat" && $game->getCurrentPlayer()->getStatus() !== "fat") {
            while ($game->getBank()->getHandValue() <= 17) {
                $game->getBank()->cardToHand($game->getDeck());
            }

            while ($game->getBank()->getHandValue() > 17 && $game->getBank()->getHandValue() < 21) {
                $game->getBank()->cardToHand($game->getDeck());

                if ($game->getBank()->getHandValue() >= 18) {
                    $game->getBank()->setStatus("happy");
                }

                if ($game->getBank()->getHandValue() > 21) {
                    $game->getBank()->setStatus("fat");
                }
            }

            if ($game->getBank()->getHandValue() === 21) {
                $game->getBank()->setStatus("winner");
            }
        }

        if ($game->getBank()->getStatus() !== "fat" && $game->getCurrentPlayer()->getStatus() !== "fat") {
            // $game->compareHands();
            $winner = $game->getWinner();
        }

        // If more players to go, call turn.
        if (count($game->players) !== 0) {
            $game->turn();
        } else {
            break;
        }
        */
        if ($game->getBank()->getStatus() === "winner" && $game->getCurrentPlayer()->getStatus() === "fat") {
            echo "Bank win!";
        }

        if ($game->getCurrentPlayer()->getStatus() === "winner" && $game->getBank()->getStatus() === "fat") {
            echo $game->getCurrentPlayer()->getPlayerString() . " win!";
        }

        // $winner = $game->getWinner();
        // echo $winner->getPlayerString() . "wins!";

        // If more players to go, call turn.
        if (count($game->getAllPlayers()) > 0) {
            $game->turn();
        } else {
            echo "Comparing hands. ";
            $winner = $game->compareHands();

            if ($winner === null) {
                $winner = "All are fat, no winner!";
            }
        }

        echo $winner;
        
        echo "Game ended, restart by session/delete";

        $output = ob_get_clean();
        
        $data = [
            "button1" => $button1,
            "button2" => $button2,
            "gameInfo" => $output,
            "player" => $game->getCurrentPlayer()->asCards(),
            "bank" => $game->getBank()->asCards(),
            "winner" => $winner,
        ];

        echo "Start";

        return $this->render('cardgame/play.html.twig', $data);
    }
}
