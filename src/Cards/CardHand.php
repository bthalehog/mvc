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
    protected string    $status = "";
    public int          $player = 0;
    protected           $wallet = 0;
    protected           $isHead = false;

    /**
     * Constructor to create instance of CardHand holding Card-objects.
     */
    public function __construct($currentDeck, int $handSize = 3)
    {
        $this->currentHand = [];
        $this->handSize = $handSize;
        $this->cardToHand($handSize, $currentDeck); // Argument is an object not a list!
        $this->status = "not_done";
        $this->player = 0;
        $this->wallet = 0;
        // return $this;
    }

    /**
     * Return cards on hand as string.
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

    /**
     * Method to get cards on hand as UTF-graphic string.
     * @return string
     */
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

    // DECOMISSIONED
    public function isHead(): bool
    {
        return $this->isHead;
    }

    // DECOMISSIONED
    public function setHead($newHead)
    {
        $this->isHead = $newHead;
    }

    /**
     * Method to get hand.
     * Return array
     */
    public function getHand(): array
    {
        return (array) $this->currentHand;
    }

    /**
     * Method to set hand with given card.
     * Return void
     */
    public function setHand($card): void
    {   
        array_push($this->currentHand, $card);
    }

    /**
     * Method to discard hand.
     */
    public function discardHand()
    {
        $this->currentHand = [];
    }

    /**
     * Method to get wallet holding cardHand won stakes.
     */
    public function getWallet(): int
    {
        return $this->wallet;
    }

    /**
     * Method to set wallet with game stake.
     */
    public function setWallet($cash)
    {
        $this->wallet += $cash;
        echo "Cash added to wallet.";
    }

    /**
     * Method to set score.
     */
    public function setScore($score)
    {
        $this->score += $score;
    }

    /**
     * Method to get score.
     * @return string
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Method to get status.
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Method to set status.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Method to get player number (eg player1 = 1).
     * @return int
     */
    public function getPlayer(): int
    {
        return $this->player;
    }

    /**
     * Method to set player.
     * Takes $order (int) as argument.
     */
    public function setPlayer($order)
    {
        $this->player = $order;
        echo "Player set to: Player" . (string)$order . ".";
    }

    /**
     * Method to get hand value.
     * @return int
     */
    public function getHandValue(): int
    {
        $score = 0;

        foreach ($this->getHand() as $card) {
            $value = $card->getValue();
            preg_match('/\d+/', $value, $match);
            $value = (int) $match[0];
            $score += $value;
        }

        return $score;
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

    /**
     * JSON-serialize hand.
     * @return mixed (array)
     */
    public function jsonSerialize(): mixed
    {
        return $this->getHand();
    }
}
