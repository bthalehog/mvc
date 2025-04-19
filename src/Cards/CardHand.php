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
    protected array  $currentHand;
    private ?int $lastDraw = null;

    public function __construct(int $numberOfCards = 3)
    {
        for ($i = 0; $i < $numberOfCards; $i++) {
            $this->currentHand[] = new Card();
        }

        $this->currentHand = $deckCount;
    }

    public function asString(): string
    {
        return (string) $this->lastDraw;
    }

    // Also writes to histogram interface.
    public function draw(): int
    {
        $this->lastDraw = rand(1, $this->deckCount);
        // $this->addToHistogram($this->lastRoll);

        return $this->lastDraw;
    }

    public function getLastDraw(): ?int
    {
        return (int) $this->lastDraw;
    }
}
