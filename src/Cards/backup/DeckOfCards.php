<?php

namespace App\Cards;

// require_once(__DIR__ . '/Card.php');

use App\Cards\Card; // Import specific class
use App\Cards\Decks; // Select deck-type

// Keep all complezity in deckofcards, let card be simple, cardhand simple.

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
    public array $deck = [];
    protected ?int $deckSize = null;
    protected array $lastDraw = [];
    protected array $lastDeal = [];
    protected string $deckType;

    /**
     * Constructor to create a deck of $deckType.
     */
    public function __construct($deckType = 'Trad52')
    {   
        $this->deckType = $deckType;
        echo $this->deckType;

        $this->deckSize = 0;

        if (strpos($deckType, '52') === true) {
            $this->deckSize = 52;
        }

        if (strpos($deckType, '54') === true) {
            $this->deckSize = 54;
        }

        echo $this->deckSize;

        for ($i = 0; $i < $this->$deckSize; $i++) {
            array_push($this->deck, new Card());
        }

        echo "Created deck";
    }

    public function asString(): string
    {
        $carrier = "";
        foreach ($this->deck as $card) {
            $carrier .= "$card->value, ";
        }

        $carrier = rtrim($carrier, ", ");

        return (string) $carrier; // might have to add (string)
    }

    // Also writes to histogram interface.
    // Decide whether it deals one card and is called repeatedly or if it takes argument and repeats call inside.
    public function dealCard(): array
    {
        $carrier = "";

        for ($i=0; $i<$amount; $i++) {
            $randInd = array_rand($this->deck);
            $dealtCard = $this->deck[$randInd];
            unset($this->deck[$randInd]);
            array_push($this->lastDeal, $dealtCard);
            $this->deckSize = count($this->deck);
        }
        return $this->lastDeal;
    }

    public function getLastDeal(): array
    {
        return $this->lastDeal;
    }

    public function getDeck(): array {
        return $this-deck;
    }
}
