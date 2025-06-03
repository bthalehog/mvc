<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{   
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCardHandMinArgument()
    {
        // Instantiate and assertInstance
        $deck = new DeckOfCards("Trad52");
        $cardHand = new CardHand($deck);

        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deck);
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        // Set expectations
        $exp = null;

        // Get comparison
        $res = $card->getValue();

        $this->assertEquals($exp, $res);
    }

    
}