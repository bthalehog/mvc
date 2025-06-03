<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
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

    /**
     * Construct object with "value"- and "graphics"-argument and verify that the object has the expected
     * properties.
     */
    public function testCreateCardWithValueAndGraphic()
    {   
        // Instantiate with "value"-argument
        $card = new Card("s2", "🂢");
        $this->assertInstanceOf("\App\Cards\Card", $card);

        // Set expectations
        $exp1 = "s2";
        $exp2 = "🂢";

        // Get comparison
        $res1 = $card->getValue();
        $res2 = $card->getGraphics();

        $this->assertEquals($exp1, $res1);
        $this->assertEquals($exp2, $res2);
    }

    /**
     * Construct object with all arguments and verify that the object has the expected
     * properties.
     */
    public function testCreateCardWithAllArguments()
    {   
        // Instantiate with "value"-argument
        $card = new Card("s2", "🂢", 2);
        $this->assertInstanceOf("\App\Cards\Card", $card);

        // Set expectations
        $exp1 = "s2";
        $exp2 = "🂢";
        $exp3 = 2;

        // Get comparison
        $res1 = $card->getValue();
        $res2 = $card->getGraphics();
        $res3 = $card->getOrder();

        $this->assertEquals($exp1, $res1);
        $this->assertEquals($exp2, $res2);
        $this->assertEquals($exp3, $res3);
    }

    /**
     * Construct object with all arguments and test to get as string.
     */
    public function testCardAsString()
    {   
        // Instantiate with "value"-argument
        $card = new Card("s2", "🂢", 2);
        $this->assertInstanceOf("\App\Cards\Card", $card);

        // Set expectations
        $exp = "s2";

        // Get comparison
        $res = $card->asString();

        $this->assertIsString($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object with all arguments and test to get status (optional use).
     */
    public function testCardGetStatus()
    {   
        // Instantiate with "value"-argument
        $card = new Card("s2", "🂢", 2);
        $this->assertInstanceOf("\App\Cards\Card", $card);

        // Set expectations
        $exp = "optional - list or string";

        // Get comparison
        $res = $card->getStatus();

        $this->assertIsString($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object with all arguments and test to get status (optional use).
     */
    public function testCardGetRelations()
    {   
        // Instantiate with "value"-argument
        $card = new Card("s2", "🂢", 2);
        $this->assertInstanceOf("\App\Cards\Card", $card);

        // Set expectations
        $exp = ["optional" => "arrayform"];

        // Get comparison
        $res = $card->getRelations();

        $this->assertIsArray($exp);
        $this->assertEquals($exp, $res);
    }
}