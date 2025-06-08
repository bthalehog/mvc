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
     * Verify setBank method without args.
     */
    public function testSetBankWithoutArgs()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        // $expPre = null;
        $resPre = $game->getBank();

        // Test
        $game->setBank();
        $resPost = $game->getBank();

        $this->assertInstanceOf("\stdClass", $resPre);
        $this->assertInstanceOf("\App\Cards\CardHand", $resPost);
    }

    /**
     * Verify setBank method with arg cardhand-object.
     */
    public function testSetBankWitArgs()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $resPre = $game->getBank();

        // Test
        $game->setBank($game->getPlayer(0));
        $resPost = $game->getBank();

        $this->assertInstanceOf("\stdClass", $resPre);
        $this->assertInstanceOf("\App\Cards\CardHand", $resPost);
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
     * Verify playerMove method.
     */
    public function testPlayerMove()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $expPre = [];
        $resPre = $game->getCurrentPlayer()->getHand();

        // Test
        $res = $game->playerMove();

        $this->assertInstanceOf("\App\Cards\Card", $res);
    }

    /**
     * Verify jsonSerialize method.
     */
    public function testJsonSerializeTwentyOne()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set expectations
        $expLen = count($deck->jsonSerialize());

        // Test method
        $res = $deck->jsonSerialize();

        // Not assertJson since the method calls getHand that returns an array
        $this->assertIsArray($res);
        $this->assertEquals($expLen, count($res));
    }

    /**
     * Verify bank's autoPull method.
     */
    public function testAutoPull()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $expPre = [];
        $resPre = $game->getBank()->getHand();

        // Test
        $game->autoPull();
        $resPost = $game->getBank()->getHand();
        $resValue = $game->getBank()->getHandValue();

        $this->assertEquals($expPre, $resPre);
        $this->assertNotNull($resPost);
        $this->assertIsInt($resValue);
    }

    /**
     * Verify bankMoveAI method when status is not "happy" and not "winner".
     */
    public function testBankMoveAINotHappyNotWinner()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $expPre = [];
        $resPre = $game->getBank()->getHand();

        // Set expectations
        $expMessage = ["Bank stays! ", "Bank hits 21! ", "Bank burst! "];
        
        // Test
        ob_start();
        $game->bankMoveAI();
        $resMessage = ob_get_clean();
        $resPost = $game->getBank()->getHand();
        $resValue = $game->getBank()->getHandValue();

        $this->assertEquals($expPre, $resPre);
        $this->assertNotNull($resPost);
        $this->assertIsInt($resValue);
        $this->assertContains($resMessage, $expMessage, "Not found");
    }

    /**
     * Verify bankMoveAI method when status "happy".
     */
    public function testBankMoveAIHappy()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "normal");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $expPre = [];
        $resPre = $game->getBank()->getHand();

        // Set expectations
        $expPost = '';

        // Test
        $game->getBank()->setStatus("happy");

        ob_start();
        $game->bankMoveAI();
        $resMessage = ob_get_clean();

        $resPost = $game->getBank()->getHand();
        $resValue = $game->getBank()->getHandValue();

        $this->assertEquals($expPre, $resPre);
        $this->assertNotNull($resPost);
        $this->assertIsInt($resValue);
        $this->assertEquals($expPost, $resMessage);
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
    /*
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
    */

    /**
     * Verify is21 method with cardhand-object not having 21.
     */
    public function testIs21Not21()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $player = $game->getCurrentPlayer();
        $this->assertInstanceOf("\App\Cards\CardHand", $player);

        $card1 = new Card("s2");
        $card2 = new Card("h3");
        $card3 = new Card("d5");

        $this->assertInstanceOf("\App\Cards\Card", $card1);
        $this->assertInstanceOf("\App\Cards\Card", $card2);
        $this->assertInstanceOf("\App\Cards\Card", $card3);

        $player->setHand($card1);
        $player->setHand($card2);
        $player->setHand($card3);

        // Set expectation
        $exp = false;

        // Test
        $hand = $player->getHand();
        $res = $game->is21($hand);

        $this->assertEquals($exp, $res);
    }

    // Identified bug in class,
    /** FUNCTIONAL - needed full hand-object.
     * Verify is21 method with cardhand-object having 21 in triple aces.
     */
    public function testIs21WithTripleAce()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $player = $game->getCurrentPlayer();
        $this->assertInstanceOf("\App\Cards\CardHand", $player);

        $card1 = new Card("s1");
        $card2 = new Card("h1");
        $card3 = new Card("d1");
        $this->assertInstanceOf("\App\Cards\Card", $card1);
        $this->assertInstanceOf("\App\Cards\Card", $card2);
        $this->assertInstanceOf("\App\Cards\Card", $card3);

        // echo $card1->asString();
        // echo $card2->asString();
        // echo $card3->asString();

        $player->setHand($card1);
        $player->setHand($card2);
        $player->setHand($card3);

        // echo $player->asString();

        // Set expectation
        $exp = true;

        // Test
        $hand = $player->getHand();
        $res = $game->is21($hand);

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify is21 method with cardhand-object having 21 with suite (3 covered).
     */
    public function testIs21WithSuite()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $player = $game->getCurrentPlayer();
        $this->assertInstanceOf("\App\Cards\CardHand", $player);

        $card1 = new Card("s11");
        $card2 = new Card("h12");
        $card3 = new Card("d13");
        $this->assertInstanceOf("\App\Cards\Card", $card1);
        $this->assertInstanceOf("\App\Cards\Card", $card2);
        $this->assertInstanceOf("\App\Cards\Card", $card3);

        $player->setHand($card1);
        $player->setHand($card2);
        $player->setHand($card3);

        // Set expectation
        $exp = true;

        // Test
        $hand = $player->getHand();
        $res = $game->is21($hand);

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify is21 method with cardhand-object having 21 with suite (2 covered 1 ace).
     */
    public function testIs21WithSuiteOfCoveredAndAce()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $player = $game->getCurrentPlayer();
        $this->assertInstanceOf("\App\Cards\CardHand", $player);

        $card1 = new Card("s11");
        $card2 = new Card("h12");
        $card3 = new Card("d1");

        $this->assertInstanceOf("\App\Cards\Card", $card1);
        $this->assertInstanceOf("\App\Cards\Card", $card2);
        $this->assertInstanceOf("\App\Cards\Card", $card3);

        $player->setHand($card1);
        $player->setHand($card2);
        $player->setHand($card3);

        // Set expectation
        $exp = true;

        // Test
        $hand = $player->getHand();
        $res = $game->is21($hand);

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify is21 method with cardhand-object having 21 with five cards non fat.
     */
    public function testIs21WithNonFatFivePlus()
    {
        $deck = new DeckOfCards("Trad52");
        $game = new TwentyOne($deck, 2, "nightmare");

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\TwentyOne", $game);

        // Setup
        $game->firstTurn();
        $player = $game->getCurrentPlayer();
        $this->assertInstanceOf("\App\Cards\CardHand", $player);

        $card1 = new Card("s2");
        $card2 = new Card("h4");
        $card3 = new Card("d3");
        $card4 = new Card("s3");
        $card5 = new Card("d2");

        $this->assertInstanceOf("\App\Cards\Card", $card1);
        $this->assertInstanceOf("\App\Cards\Card", $card2);
        $this->assertInstanceOf("\App\Cards\Card", $card3);
        $this->assertInstanceOf("\App\Cards\Card", $card4);
        $this->assertInstanceOf("\App\Cards\Card", $card5);
        
        $player->setHand($card1);
        $player->setHand($card2);
        $player->setHand($card3);
        $player->setHand($card4);
        $player->setHand($card5);

        // Set expectation
        $exp = true;

        // Test
        $hand = $player->getHand();
        $res = $game->is21($hand);

        $this->assertEquals($exp, $res);
    }

    /** Original class modified, now working.
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
        $expPlayer = 99999; // Bc Bank win on tie.
        $expStatus = ""; // Since bank get cleared after winner status used.

        // Test
        $game->firstTurn();
        echo $game->getBank()->getPlayer();

        $game->getBank()->setHand(new Card("s3"));
        $game->getBank()->setHand(new Card("h4"));
        $game->getBank()->setHand(new Card("d7"));

        $game->getCurrentPlayer()->setHand(new Card("h3"));
        $game->getCurrentPlayer()->setHand(new Card("d4"));
        $game->getCurrentPlayer()->setHand(new Card("s7"));

        $game->getBank()->setStatus("happy");
        $game->getCurrentPlayer()->setStatus("happy");

        $winner = $game->determineWinner();

        $resPlayer = $winner->getPlayer();
        $resStatus = $winner->getStatus();

        $this->assertEquals($expPlayer, $resPlayer);
        $this->assertEquals($expStatus, $resStatus);
    }
}
