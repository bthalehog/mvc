<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;
use App\Cards\Card;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{   
    /**
     * Construct object with minimal arguments (deck) and verify that the object has the expected
     * properties.
     */
    public function testCreateCardHandMinArguments()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 3;

        // Get comparison
        $res = $cardHand->handSize;

        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object with all arguments (deck, handSize) and verify that the object has the expected
     * properties.
     */
    public function testCreateCardHandAllArguments()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck, 5);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 5;

        // Get comparison
        $res = $cardHand->handSize;

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify string-return method.
     */
    public function testGetCardHandAsString()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        $res = $cardHand->asString();

        $this->assertIsString($res);
    }

    /**
     * Verify getHand method.
     */
    public function testGetHand()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $expLen = 3;

        $res = $cardHand->getHand();
        $res2 = count($res);

        $this->assertIsArray($res);
        $this->assertEquals($expLen, $res2);
    }

    /**
     * Verify discardHand method.
     */
    public function testDiscardHand()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $expLen = 0;

        // Test method
        $cardHand->discardHand();
        $res = $cardHand->getHand();
        $res2 = count($res);

        $this->assertIsArray($res);
        $this->assertEquals($expLen, $res2);
    }

    /**
     * Verify getWallet method.
     */
    public function testGetWallet()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 0;

        // Test method
        $res = $cardHand->getWallet();

        $this->assertIsInt($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify setWallet method.
     */
    public function testSetWallet()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 50;

        // Test method
        $cardHand->setWallet(50);
        $res = $cardHand->getWallet();

        $this->assertIsInt($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify getScore method.
     */
    public function testGetScore()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 0;

        // Test method
        $res = $cardHand->getScore();

        $this->assertIsInt($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify setScore method.
     */
    public function testSetScore()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 1;

        // Test method
        $cardHand->setScore(1);
        $res = $cardHand->getScore();

        $this->assertIsInt($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify getStatus method.
     */
    public function testGetStatus()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = "not_done";

        // Test method
        $res = $cardHand->getStatus();

        $this->assertIsString($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify setStatus method.
     */
    public function testSetStatus()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = "status set";

        // Test method
        $cardHand->setStatus("status set");
        $res = $cardHand->getStatus();

        $this->assertIsString($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify getPlayer method.
     */
    public function testGetPlayer()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 0;

        // Test method
        $res = $cardHand->getPlayer();

        $this->assertIsInt($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify setPlayer method.
     */
    public function testSetPlayer()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = 5;

        // Test method
        $cardHand->setPlayer(5);
        $res = $cardHand->getPlayer();

        $this->assertIsInt($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify getHandValue method.
     */
    public function testGetHandValue()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Test method
        $res = $cardHand->getHandValue();

        $this->assertIsInt($res);
    }

    /**
     * Verify sacrifice method.
     */
    public function testSacrifice()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $expLenPre = 3;
        $expLenPost = 1;

        // Test method
        $resPreLen = count($cardHand->getHand());

        $cards = $cardHand->getHand();
        $cardArray = [0, 1];
        $cardHand->sacrifice($cardArray);

        $resPostLen = count($cardHand->getHand());

        $this->assertIsInt($resPreLen);
        $this->assertIsInt($resPostLen);
        $this->assertEquals($expLenPre, $resPreLen);
        $this->assertEquals($expLenPost, $resPostLen);
    }

    /**
     * Verify getLastSacrifice method.
     */
    public function testGetLastSacrifice()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = [0, 1];

        // Make sacrifice
        $cards = $cardHand->getHand();
        $cardHand->sacrifice($exp);

        // Test method
        $res = $cardHand->getLastSacrifice();

        $this->assertIsArray($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify cardToHand method.
     */
    public function testCardToHand()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $expLenPre = 3;
        $expLenPost = 4;

        // Test method
        $resPreLen = count($cardHand->getHand());
        $cardHand->cardToHand(1, $deck);

        $resPostLen = count($cardHand->getHand());

        $this->assertIsInt($resPreLen);
        $this->assertIsInt($resPostLen);
        $this->assertEquals($expLenPre, $resPreLen);
        $this->assertEquals($expLenPost, $resPostLen);
    }

    /**
     * Verify getLastDraw method.
     */
    public function testGetLastDraw()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Make draw
        $cardHand->cardToHand(1, $deck);

        // Set expectations
        $postDraw = $cardHand->getHand();
        $exp = $postDraw[0]->asString();

        // Test method
        $lastDraw = $cardHand->getLastDraw();
        echo strval($lastDraw[0]->asString());
        echo strval($postDraw[0]->asString());
        $res = $lastDraw[0]->asString();

        $this->assertIsArray($postDraw);
        $this->assertIsArray($lastDraw);
        $this->assertInstanceOf("\App\Cards\Card", $postDraw[0]);
        $this->assertInstanceOf("\App\Cards\Card", $lastDraw[0]);

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify jsonSerialize method.
     */
    public function testJsonSerialize()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Test method
        $res = $cardHand->jsonSerialize();

        // Not assertJson since the method calls getHand that returns an array
        $this->assertIsArray($res);
    }    
}
