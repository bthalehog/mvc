<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardsTest extends TestCase
{   
    /**
     * Construct object and verify that the object has the expected base
     * properties.
     */
    public function testCreateDeckMinArguments()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set expectations
        $expType = "Trad52";
        $expSize = 52;

        // Get comparison
        $resType = $deck->getType();
        $resSize = $deck->getSize();

        $this->assertEquals($expType, $resType);
        $this->assertEquals($expSize, $resSize);
    }

    /**
     * Verify deck as string method
     */
    public function testDeckAsString()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Get comparison
        $res = $deck->asString();
        $this->assertIsString($res);
    }

    /**
     * Verify deck as cards method returning string (graphic-UTF)
     */
    public function testDeckAsCards()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Test
        $res = $deck->asCards();
        $this->assertIsString($res);
    }

    /**
     * Verify deal method
     */
    public function testDealCard()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Test
        $res = $deck->dealCard();
        $this->assertInstanceOf("\App\Cards\Card", $res);
    }

    /**
     * Verify getLastDeal method
     */
    public function testGetLastDeal()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set up
        $cardDealt = $deck->dealCard();

        // Test
        $res = $deck->getLastDeal();

        $this->assertInstanceOf("\App\Cards\Card", $cardDealt);
        $this->assertIsArray($res);
        $this->assertEquals($cardDealt, $res[0]);
    }

    /**
     * Verify getDeck method
     */
    public function testGetDeck()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set expectations
        $expLen = 52;

        // Test
        $res = $deck->getDeck();
        $resLen = count($res);

        $this->assertIsArray($res);
        $this->assertEquals($expLen, $resLen);
    }

    /**
     * Verify getSize method (already tested in getDeck)
     */
    public function testGetSize()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set expectations
        $expLen = 52;

        // Test
        $res = $deck->getDeck();
        $resLen = count($res);

        $this->assertEquals($expLen, $resLen);
    }

    /**
     * Verify sortDeck method
     */
    public function testSortDeck()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set expectations
        $expFirstOrder = 1;

        // Test
        $deck->sortDeck();
        $sortedDeck = $deck->getDeck();

        $firstCard = $sortedDeck[0];
        $resFirstOrder = $firstCard->getOrder();

        $this->assertEquals($expFirstOrder, $resFirstOrder);
    }

    /**
     * Verify shuffleDeck method
     */
    public function testShuffleDeck()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set expectations
        $expFirstOrder = 1;

        // Sort
        $deck->sortDeck();
        $sortedDeck = $deck->getDeck();

        $firstCardSorted = $sortedDeck[0];
        $secondCardSorted = $sortedDeck[1];
        $thirdCardSorted = $sortedDeck[2];
        $sortedTestArray = [$firstCardSorted->getValue(), $secondCardSorted->getValue(), $thirdCardSorted->getValue()];

        // Shuffle
        $deck->shuffleDeck();
        $shuffledDeck = $deck->getDeck();
        $firstCardShuffled = $shuffledDeck[0];
        $secondCardShuffled = $shuffledDeck[1];
        $thirdCardShuffled = $shuffledDeck[2];

        $shuffledTestArray = [$firstCardShuffled->getValue(), $secondCardShuffled->getValue(), $thirdCardShuffled->getValue()];

        $this->assertNotEquals($sortedTestArray, $shuffledTestArray);
    }

    /**
     * Verify findByOrder method
     */
    public function testFindByOrder()
    {
        $deck = new DeckOfCards("Trad52");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);

        // Set expectations
        $expValueFound = "s2";

        // Test
        $found = $deck->findByOrder("2");
        $res = $found->getValue();

        $this->assertEquals($expValueFound, $res);
    }

    /**
     * Verify deck method
     */
    public function testDeck()
    {
        $deckTrad52 = new DeckOfCards("Trad52");
        $deckTrad54 = new DeckOfCards("Trad54");
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deckTrad52);
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deckTrad54);

        // Set expectations
        $exp52Len = 52;
        $exp54Len = 54;

        // Test
        $Trad52Len = count($deckTrad52->getDeck());
        $Trad54Len = count($deckTrad54->getDeck());

        $this->assertIsArray($deckTrad52->getDeck());
        $this->assertIsArray($deckTrad54->getDeck());
        $this->assertEquals($exp52Len, $Trad52Len);
        $this->assertEquals($exp54Len, $Trad54Len);
    }

    /**
     * Verify jsonSerialize method.
     */
    public function testJsonSerializeDeck()
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
















    
}