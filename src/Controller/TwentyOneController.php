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

            echo $numberOfPlayersInput;
            echo $difficultyInput;
            echo "Nothing shown?";

            if ($request->isMethod('POST') && $numberOfPlayersInput !== null && $difficultyInput !== null) {
                // Create game from input
                $deck = new DeckOfCards('Trad52');
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
    public function start(SessionInterface $session)
    {   
        $game = $session->get('game');

        $button1 = '<button type="submit" id="playerButtonDraw" class="playerButton">Draw card</button>';
        $button2 = '<button type="submit" id="playerButtonStay" class="playerButton">Stay</button>';

        // $currentPlayer = $game->getCurrentPlayer();
        $game->setBank();

        // while ($game->getBank()->getStatus() !== "happy" || $game->currentPlayer()->getStatus() !== "happy") {
        //    if ($currentPlayer !== null && $currentPlayer->getStatus === "done") {
        //        $game->turn();
        //    }
        //
        //       $game->currentPlayer->asCards();

        //    $game->currentPlayer->cardToHand(1, $game->getDeck()->dealCard());

        //    echo "Here now";
        // }

        $data = [
            "button1" => $button1,
            "button2" => $button2,
        ];

        echo "Start";

        return $this->render('cardgame/play.html.twig', $data);
    }
}
