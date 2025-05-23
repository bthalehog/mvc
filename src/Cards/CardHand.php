<?php

namespace App\Cards;

// namespace alhf24\Cards; // For running with index_card.php

// require_once(__DIR__ . '/Card.php');

use App\Cards\DeckOfCards;

/**
 * CardHand-class
 * Holds Card-object for playing a card game.
 */
class CardHand
{
    /**
     * @var array   $currentHand    The cards on hand.
     * @var integer $lastDraw       The value of the last draw.
     * @var integer $handSize       The amount of cards on hand.
     * @var array   $lastSacrifice  The last cards sacrificed.
     * @var int     $score          The score the cardHand constitutes.
     * @var string  $status         The status held by cardHand.
     */
    protected array     $currentHand = [];
    private array       $lastDraw = [];
    public ?int         $handSize = null;
    private array       $lastSacrifice = [];
    protected int	    $score = 0;
    protected string    $status= "";

    /**
     * Constructor to create instance of CardHand holding Card-objects.
     */
    public function __construct($currentDeck, int $handSize = 3)
    {
        $this->currentHand = [];
        $this->handSize = $handSize;
        $this->cardToHand($handSize, $currentDeck); // Argument is an object not a list!
        $this->status = "not_done";
        // return $this;
    }

    /**
     * Return cards on hand as string.
     *
     * @return string as representation of cards on hand.
     */
    public function asString(): string
    {
        $stringer = "";

        foreach ($this->currentHand as $card) {
            $stringer .= $card->asString();
            // echo $card->value;
            // echo "stringed";
        }

        return (string) $stringer;
    }

    public function asCards(): string
    {
        $stringer = "";

        foreach ($this->currentHand as $card) {
            $stringer .= $card->getGraphics() . " ";
            // echo $card->value;
            // echo "stringed";
        }

        return (string) $stringer;
    }

    public function getHand(): array
    {
        return (array) $this->currentHand;
    }
    
    public function setScore($score)
    {
		$this->score += $score;
        // echo "Score added";
    }
    
    public function getScore(): int
    {
		return $this->score;
    }

    public function getStatus(): string
    {
		return $this->status;
    }

    /**
     * Sacrifices cards (array).
     *
     * @return void
     */
    public function sacrifice(array $sacrifice): void
    {
        $this->lastSacrifice = $sacrifice;

        foreach ($sacrifice as $card) {
            unset($this->currentHand[$card]);
            $this->handSize - 1;
            echo "Sacrificing: $card";
        }
    }

    /**
     * Draw cards to hand to restore hand-size.
     *
     * @return void
     */
    public function cardToHand($amount, ?DeckOfCards $currentDeck = null): void
    {
        /// draw from Deck three times and
        $card = null;

        if (!$currentDeck instanceof DeckOfCards) {
            $currentDeck = new DeckOfCards('Trad52');
        }

        // Draw method is singular, loop amount of card times.
        for ($i = 0; $i < $amount; $i++) {
            $card = $currentDeck->dealCard();
            array_push($this->currentHand, $card);
            // array_push($this->lastDraw, (array_push($this->currentHand, $this->dealCard())));
            $this->lastDraw[] = $card;
        }
    }

    /**
     * Show last sacrificed cards from hand.
     *
     * @return array as representation of the cards sacrificed.
     */
    public function getLastSacrifice(): array
    {
        return $this->lastSacrifice;
    }

    /**
     * Show last cards drawn to hand.
     *
     * @return array as representation of the cards drawn and added.
     */
    public function getLastDraw(): array
    {
        return $this->lastDraw;
    }
}
