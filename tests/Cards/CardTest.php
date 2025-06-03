<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class CardTest extends TestCase
{   
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCardNoArguments()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Cards\Card", $card);

        // Set expectations
        $exp = null;

        // Get comparison
        $res = $card->getValue();

        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object with "value"-argument and verify that the object has the expected
     * properties.
     */
    public function testCreateCardWithValue()
    {   
        // Instantiate with "value"-argument
        $card = new Card("s2");
        $this->assertInstanceOf("\App\Cards\Card", $card);

        // Set expectations
        $exp = "s2";

        // Get comparison
        $res = $card->getValue();

        $this->assertEquals($exp, $res);
    }
}