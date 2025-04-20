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
    private ?int $deckSize = null;
    protected array $lastDraw;
    protected array $lastDeal;

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

        return (string) $carrier; // might have to add (string)
    }

    // Also writes to histogram interface.
    // Decide whether it deals one card and is called repeatedly or if it takes argument and repeats call inside.
    public function dealCards(int $amount): void
    {
        $carrier = "";

        for ($i=0; $i<$amount; $i++) {
            $randInd = array_rand($this->deck);
            $dealtCard = $this->deck[$randInd];
            unset($this->deck[$randInd]);
            array_push($this->lastDeal, $dealtCard);
            $this->deckSize = count($this->deck);
        }

        // $this->addToHistogram($this->lastDraw); 

        // return $this->lastDeal; // Make to own method
    }

    public function getLastDeal(): array
    {

        return (array) $this->lastDeal;
    }
}
