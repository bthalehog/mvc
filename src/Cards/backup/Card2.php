<?php

// namespace App\Cards;

// Need to implement control and remove structure of already drawn cards, similar to the one made in deckofcards where we pop all used values and rand-chose from the remaining until no more cards?
// New Card should only be instantiated from DeckOfCards since on creation the cardIndex of Card-class will be emptied and transferred as card-objects into the deckClass.
// Deckclass then replaces card when querying from controller.
// Therefore no calls to Card should be made from the controller-script when creating card, all cards drawn must come from deck, deck must be an argument in such calls.

/**
 * Card-class
 */
class Card
{
    /**
     * @var array   $cardIndex      The deck of cards (52, French-English standard - no jokers).
     * @var string  $lastDraw       The last card drawn.
     * @var int     $deckSize       The size of the deck.
     * @var string  $value          The cards value.
     * @var string  $card           The card.
     */
    protected string $card;
    public string $value = "";
    private ?int $deckSize = null;
    private string $lastDraw = "";
    protected array $cardIndex = [
        ["value" => "s1", "status" => "in"], ["value" => "s2", "status" => "in"], ["value" => "s3", "status" => "in"], ["value" => "s4", "status" => "in"], ["value" => "s5", "status" => "in"], ["value" => "s6", "status" => "in"], ["value" => "s7", "status" => "in"], ["value" => "s8", "status" => "in"], ["value" => "s9", "status" => "in"], ["value" => "s10", "status" => "in"], ["value" => "s11", "status" => "in"], ["value" => "s12", "status" => "in"], ["value" => "s13", "status" => "in"],
        ["value" => "c1", "status" => "in"], ["value" => "c2", "status" => "in"], ["value" => "c3", "status" => "in"], ["value" => "c4", "status" => "in"], ["value" => "c5", "status" => "in"], ["value" => "c6", "status" => "in"], ["value" => "c7", "status" => "in"], ["value" => "c8", "status" => "in"], ["value" => "c9", "status" => "in"], ["value" => "c10", "status" => "in"], ["value" => "c11", "status" => "in"], ["value" => "c12", "status" => "in"], ["value" => "c13", "status" => "in"],
        ["value" => "d1", "status" => "in"], ["value" => "d2", "status" => "in"], ["value" => "d3", "status" => "in"], ["value" => "d4", "status" => "in"], ["value" => "d5", "status" => "in"], ["value" => "d6", "status" => "in"], ["value" => "d7", "status" => "in"], ["value" => "d8", "status" => "in"], ["value" => "d9", "status" => "in"], ["value" => "d10", "status" => "in"], ["value" => "d11", "status" => "in"], ["value" => "d12", "status" => "in"], ["value" => "d13", "status" => "in"],
        ["value" => "h1", "status" => "in"], ["value" => "h2", "status" => "in"], ["value" => "h3", "status" => "in"], ["value" => "h4", "status" => "in"], ["value" => "h5", "status" => "in"], ["value" => "h6", "status" => "in"], ["value" => "h7", "status" => "in"], ["value" => "h8", "status" => "in"], ["value" => "h9", "status" => "in"], ["value" => "h10", "status" => "in"], ["value" => "h11", "status" => "in"], ["value" => "h12", "status" => "in"], ["value" => "h13", "status" => "in"]
    ];

    /**
     * Constructor to create instance of card.
     */
    public function __construct(int $possibilities = 52)
    {
        $this->deckSize = $possibilities;
        $this->value = "";
        $this->card = "";
        $this->draw();
    }

    // Also writes to histogram interface.
    public function draw(): void
    {
        // This need selection
        $randSelector = rand(0, $this->deckSize - 1);
        $this->value = $this->cardIndex[$randSelector]["value"]; // "value" instead? "value"=>"s1" or better to pop?
        $this->cardIndex[$randSelector]["status"] = "out";

        $this->lastDraw = $this->value;
        // $this->addToHistogram($this->lastDraw);
    }

    public function asString(): string
    {
        return $this->value;
    }

    public function getLastDraw(): string
    {
        return $this->value;
    }
}
