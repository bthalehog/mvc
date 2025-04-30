<?php

namespace App\Controller;


/*

FLOWCHART to implement

game = new Game(); 	// Create game
sessionHandler(game); 	// Init and write to session
game.selectRuleSet(); 	// Select ruleset (normal or with specialCases)
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
    public function twentyOne()
    {   
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
        
        $difficulty = '<label for="difficulty">Select difficulty</label><select id="difficulty"><option value="normal">Normal</option><option value="nightmare">Nightmare</option></select>';
        $players = '<label for="numberOfPlayers">Number of players</label><input id="numberOfPlayers" type="number"></input>';
        $button = '<button type="submit" class="cardGameButton">Start game!</button>';
        $deck = null;
        $game = null;

        $deck = new DeckOfCards('Trad52');
        $card = $deck->dealCard();
        $game = new TwentyOne($deck, 2, 'nightmare');

        $data = [
            "rules" => $rules,
            "difficulty" => $difficulty,
            "players" => $players,
            "button" => $button,
            "game" => $game
        ];

        return $this->render('cardgame/cardgame.html.twig', $data);
    }

    #[Route("/game/twentyone/start", name: "start")]
    public function start()
    {  
        if (!$session->has('game')) {
            // These values should come from buttons on startpage amountOfPlayers and difficulty.
            $game = $this;
            $session->set('game', $game);
            echo "No game in session, rerouting...";
            return $this->redirectToRoute('session_start');
        } else {
            $deck = $session->get('game');
            echo "Loaded from session";
        }
    }
}
