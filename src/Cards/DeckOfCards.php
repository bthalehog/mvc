<?php

namespace App\Cards;

// require_once(__DIR__ . '/Card.php');

// use App\Cards\Card; // Import specific class

/**
 * CardHand-class
 * Holds Card-object for playing a card game.
 */
class DeckOfCards
{
    /**
     * @var array $deck             Array holding all the (remaining) cards of the deck.
     * @var integer $deckSize       Defining the size of the deck used (better as tuple?).
     * @var array $lastDraw         Array holding the last cards drawn (also writes draws to histogram).
     */

    protected array  $deck;
    private ?int $deckSize = null;
    protected array $lastDraw;

    public function __construct(int $deckSize = 52)
    {
        $this->deckSize = $deckSize;

        for ($i = 0; $i < $deckSize; $i++) {
            array_push($this->deck, new Card());
        }
    }

    public function asString(): string
    {
        $carrier = "";
        foreach ($this->deck as $card) {
            $carrier .= "$card, ";
        }

        $carrier = rtrim($carrier, ", ");

        return $carrier; // might have to add (string)
    }

    // Also writes to histogram interface.
    public function draw(): int
    {
        $this->lastDraw = rand(1, $this->deckSize);
        // $this->addToHistogram($this->lastDraw);

        return $this->lastDraw;
    }

    public function getLastDraw(): ?array
    {

        return (array) $this->lastDraw;
    }
}
