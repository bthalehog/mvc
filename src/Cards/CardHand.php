<?php

namespace App\Cards;

// namespace alhf24\Cards; // For running with index_card.php

// require_once(__DIR__ . '/Card.php');

// use App\Cards\Card;

/**
 * CardHand-class
 * Holds Card-object for playing a card game.
 */
class CardHand
{
    /**
     * @var array $currentHand      The cards on hand.
     * @var integer $lastDraw       The value of the last draw and the last sacrifice (better as tuple?).
     */
    protected array     $currentHand;
    private   array     $lastDraw;
    private   ?int      $handSize = null;
    private   array     $lastSacrifice;

    public function __construct(int $numberOfCards = 3)
    {
        $this->handSize = $numberOfCards;

        for ($i = 0; $i < $numberOfCards; $i++) {
            $this->currentHand[] = new Card();
        }
    }

    public function asString(): string
    {
        foreach ($this->currentHand as $card) {
            echo (string) $card; //print_r?
        }
        return (string) $this->currentHand; //print_r
    }

    public function sacrifice(array $sacrifice): void
    {   
        $this->lastSacrifice = $sacrifice;

        foreach ($sacrifice as $card) {
            unset($this->currentHand[$card]);
            echo "Sacrificing: $card";
        }

        for ($i=0; $i<$sacrifice; $i++) {
            
        }
    }

    public function cardToHand($numberOfCards): void {
        for($i=0; $i < ($this->handSize - $this->lastSacrifice); $i++) {
            // array_push($this->currentHand, new Card());
            array_push($this->lastDraw, (array_push($this->currentHand, new Card())));
        }
    }

    public function getLastSacrifice(): array
    {
        return $this->lastSacrifice;
    }

    public function getLastDraw(): array
    {
        return $this->lastDraw;
    }
}
