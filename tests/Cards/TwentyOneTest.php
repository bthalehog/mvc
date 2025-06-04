<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class TwentyOneTest extends TestCase
{   
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateGame()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);
    }

    /**
     * Verify setter and getter for CurrentPlayerIndex.
     */
    public function testSetGetCurrentPlayerIndex()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectation
        $exp = 3;

        // Set up
        $game->setCurrentPlayerIndex(3);
        $res = $game->getCurrentPlayerIndex();

        // Test
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify addDeck method.
     */
    public function testAddDeck()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectation
        $expLen = 54;

        // Set up
        $newDeck = new DeckOfCards("Trad54");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $newDeck);
        
        $game->addDeck($newDeck);
        $setDeck = $game->getDeck();
        $resLen = count($setDeck->getDeck());

        // Test
        $this->assertEquals($expLen, $resLen);
    }

    /**
     * Verify addPlayer method with arguments.
     */
    public function testAddPlayerWithArg()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectation
        $exp = 5;

        // Set up        
        $game->addPlayer(3);
        $res = count($game->getAllPlayers());

        // Test
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify addPlayer method without arg.
     */
    public function testAddPlayerWithoutArg()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectation
        $exp = 2;

        // Set up        
        $game->addPlayer();
        $res = count($game->getAllPlayers());

        // Test
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify addPlayer method with the 100 argument that sets it as bank,
     * de facto testing the setter/getter for bank.
     */
    public function testAddPlayerWith100Arg()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set pre-state
        $resPre = $game->getBank();

        // Set post-state        
        $game->addPlayer(100);
        $res = $game->getBank();
        $expNumber = 99999;
        $bankPlayerNumber = $res->getPlayer();

        // Test
        $this->assertInstanceOf("\stdClass", $resPre);
        $this->assertInstanceOf("\App\Cards\CardHand", $res);
        $this->assertEquals($expNumber, $bankPlayerNumber);
    }

    /**
     * Verify setDifficulty method with arguments.
     */
    public function testSetDifficultyWithArg()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set pre-state
        $expPre = "normal";
        $resPre = $game->getDifficulty();

        // Set post-state
        $expPost = "nightmare";
        $game->setDifficulty("nightmare");
        $resPost = $game->getDifficulty();

        // Test
        $this->assertEquals($expPre, $resPre);
        $this->assertEquals($expPost, $resPost);
    }

    /**
     * Verify setDifficulty without arguments.
     */
    public function testSetDifficultyWithoutArg()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set pre-state
        $expPre = "normal";
        $resPre = $game->getDifficulty();
        $this->assertEquals($expPre, $resPre);

        // Test
        $this->expectException(\ArgumentCountError::class);
        $game->setDifficulty();
    }

    /**
     * Verify setStake method with arguments.
     */
    public function testSetGetStakeWithArg()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set pre-state
        $expPre = 0;
        $resPre = $game->getStake();

        // Set post-state
        $expPost = 50;
        $game->setStake(50);
        $resPost = $game->getStake();

        // Test
        $this->assertEquals($expPre, $resPre);
        $this->assertEquals($expPost, $resPost);
    }

    /**
     * Verify setStake method without arguments (raise error).
     */
    public function testSetStakeWithoutArg()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set up for error
        $this->expectException(\ArgumentCountError::class);
        $game->setStake();
    }

    /**
     * Verify getDeckString method.
     */
    public function testGetDeckString()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        $res = $game->getDeckString();

        // Test
        $this->assertIsString($res);
    }

    /**
     * Verify setter/getter for currentPlayer.
     */
    public function testSetGetCurrentPlayer()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expPlayerIndex = 1;

        // Setup
        $playerToSetAsCurrent = $game->getPlayer(1);
        $game->setCurrentPlayer($playerToSetAsCurrent);
        $currentPlayer = $game->getCurrentPlayer();
        $resPlayerIndex = $currentPlayer->getPlayer();

        // Test
        $this->assertEquals($expPlayerIndex, $resPlayerIndex);
    }

    /**
     * Verify playerCount method.
     */
    public function testPlayerCount()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expCount = 2;

        // Setup
        $resCount = $game->playerCount();

        // Test
        $this->assertEquals($expCount, $resCount);
    }

    /**
     * Verify dealCard method.
     * Always using the one in deck. Not testable like this, can remove?
     */

    /**
     * Verify shuffleDeck method
     * Always using the one in deck. Not testable like this, can remove?
     */

    /**
     * Verify cardValueIndexer method
     */
    public function testCardValueIndexer()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");
        $card = new Card("s2");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);
        $this->assertInstanceOf("\App\Cards\Card", $card);
        // Set expectations
        $exp = 2;

        // Test
        $res = $game->cardValueIndexer($card);

        $this->assertEquals($exp, $res);
    }
    
    /**
     * Verify setter/getter status method
     */
    public function testSetGetStatus()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $exp = "winner";

        // Test
        $game->getPlayer(1)->setStatus("winner");
        $res = $game->getPlayer(1)->getStatus();

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify getRules method
     */
    public function testGetRules()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Test
        $res = $game->getRules();

        $this->assertIsString($res);
    }

    /**
     * Verify nextPlayer method
     */
    public function testNextPlayer()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 3, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->setCurrentPlayer($game->getPlayer(0));
        $expPre = 0;
        $resPre = $game->getCurrentPlayerIndex();

        // Test
        $expPost = 1;
        $game->nextPlayer();
        $resPost = $game->getCurrentPlayerIndex();

        $this->assertEquals($expPre, $resPre);
        $this->assertEquals($expPost, $resPost);
    }

    /**
     * Verify lastPlayer method return false
     */
    public function testLastPlayerFalse()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 3, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->setCurrentPlayer($game->getPlayer(0));
        $expPre = 0;
        $resPre = $game->getCurrentPlayerIndex();

        // Test
        $expPost = false;
        $game->nextPlayer();
        $resPost = $game->lastPlayer();

        $this->assertEquals($expPre, $resPre);
        $this->assertEquals($expPost, $resPost);
    }

    /**
     * Verify lastPlayer method return true
     */
    public function testLastPlayerTrue()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->setCurrentPlayer($game->getPlayer(0));
        $expPre = 0;
        $resPre = $game->getCurrentPlayerIndex();

        // Test
        $expPost = true;
        $game->nextPlayer();
        $resPost = $game->lastPlayer();

        $this->assertEquals($expPre, $resPre);
        $this->assertEquals($expPost, $resPost);
    }

    /**
     * Verify getWinner method
     */
    public function testGetWinner()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 3, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expStatus = "winner";

        // Setup
        $game->setCurrentPlayer($game->getPlayer(0));
        $game->getCurrentPlayer()->setStatus("winner");

        // Test
        $winningCardHand = $game->getWinner();
        $this->assertInstanceOf("\App\Cards\CardHand", $winningCardHand);
        $resStatus = $winningCardHand->getStatus();        

        $this->assertEquals($expStatus, $resStatus);
    }

    /**
     * Verify determineWinner method in a game where bank wins
     */
    public function testDetermineWinnerBank()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expPlayer = 99999;
        $expStatus = "";

        // Test
        $game->addPlayer(100); // 100 sets bank, yes not the smartest solution in hindsight..
        $game->getBank()->setStatus("winner");
        $game->getPlayer(0)->setStatus("happy");

        $winner = $game->determineWinner();

        $resPlayer = $winner->getPlayer();
        $resStatus = $winner->getStatus();

        $this->assertEquals($expPlayer, $resPlayer);
        $this->assertEquals($expStatus, $resStatus);
    }

    /**
     * Verify determineWinner method in a game where Player wins
     */
    public function testDetermineWinnerPlayerBankFat()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 3, "normal"); // WHy not working with two players?

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expPlayer = 0;
        $expStatus = "winner"; // SHould this also be cleared in function as bank?

        // Test
        $game->firstTurn();
        $game->getBank()->setStatus("fat");
        $game->getCurrentPlayer()->setStatus("winner");

        $winner = $game->determineWinner();

        $resPlayer = $winner->getPlayer();
        $resStatus = $winner->getStatus();

        $this->assertEquals($expPlayer, $resPlayer);
        $this->assertEquals($expStatus, $resStatus);
    }

    /**
     * Verify determineWinner method in a game where bank is "fat" and player "happy".
     */
    public function testDetermineWinnerBankFatPlayerHappy()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 3, "normal"); // WHy not working with two players?

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expPlayer = 0;
        $expStatus = "happy"; // SHould this also be cleared in function as bank?

        // Test
        $game->firstTurn();
        $game->getBank()->setStatus("fat");
        $game->getCurrentPlayer()->setStatus("happy");

        $winner = $game->determineWinner();

        $resPlayer = $winner->getPlayer();
        $resStatus = $winner->getStatus();

        $this->assertEquals($expPlayer, $resPlayer);
        $this->assertEquals($expStatus, $resStatus);
    }

    /**
     * Verify determineWinner method in a game where bank is "happy" and player "happy"
     * and bank has the higher value (below 21) on hand.
     */
    public function testDetermineWinnerBankHappyPlayerHappy()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 3, "normal"); // WHy not working with two players?

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expPlayer = 99999; // If bank has higher value hand
        $expStatus = ""; // Since bank get cleared after winner status used.

        // Test
        $game->firstTurn();
        $game->getBank(); // Need to set the hand to something below 21
        $game->getCurrentPlayer(); // Need to set the hand to something below 21
        $game->getBank()->setStatus("happy");
        $game->getCurrentPlayer()->setStatus("happy");

        $winner = $game->determineWinner();

        $resPlayer = $winner->getPlayer();
        $resStatus = $winner->getStatus();

        $this->assertEquals($expPlayer, $resPlayer);
        $this->assertEquals($expStatus, $resStatus);
    }
    
    /**
     * Verify determineWinner method in a game where bank is "happy" and player "happy"
     * and bank has the higher value (below 21) on hand.
     */
    public function testDetermineWinnerTie()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 3, "normal"); // WHy not working with two players?

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Set expectations
        $expPlayer = 99999; // If bank has higher value hand
        $expStatus = ""; // Since bank get cleared after winner status used.

        // Test
        $game->firstTurn();
        $game->getBank(); // Need to set same value hand
        $game->getCurrentPlayer(); // Need to set same value hand
        $game->getBank()->setStatus("happy");
        $game->getCurrentPlayer()->setStatus("happy");

        $winner = $game->determineWinner();

        $resPlayer = $winner->getPlayer();
        $resStatus = $winner->getStatus();

        $this->assertEquals($expPlayer, $resPlayer);
        $this->assertEquals($expStatus, $resStatus);
    }

}
