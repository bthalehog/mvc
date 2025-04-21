<?php

namespace App\Cards;

// Need to implement control and remove structure of already drawn cards, similar to the one made in deckofcards where we pop all used values and rand-chose from the remaining until no more cards?
// New Card should only be instantiated from DeckOfCards since on creation the cardIndex of Card-class will be emptied and transferred as card-objects into the deckClass.
// Deckclass then replaces card when querying from controller.
// Therefore no calls to Card should be made from the controller-script when creating card, all cards drawn must come from deck, deck must be an argument in such calls.
// Cards-"Status" to be reserved for future flipping of cards, no longer needed for indication after deciding to pop for above-mentionend transfer of deck between classes.

// use App\Cards\Decks;

/**
 * Card-class
 */
class Card
{
    /**
     * @var string  $value          The cards value.
     * @var string  $status         Reserved for optionals (["show", "hide", "sacrifice", "hold"]).
     * @var string  $relations      Reserved for optionals (["parent", ["myDeck", "diamonds"], "child", ["bare", "royal"], "sibling", [$value+1, $value-1]]]).
     * @var string  $graphics       Holds graphical representation in utf-8.
     */
    protected ?string $value = "";
    protected string $status = "";
    protected array $relations = [];
    protected ?string $graphics = "";
    private ?int $order;

    /**
     * Constructor to create instance of card.
     */
    public function __construct(string $value = null, string $graphics = null, int $order = null)
    {
        $this->value = $value;
        $this->status = "optional - list or string";
        $this->relations = ["optional"=>"arrayform"];
        $this->graphics = $graphics;
        $this->order = $order;
    }

    public function asString(): string
    {
        return (string) $this->value;
    }

    public function getValue(): string {
        return (string) $this->value;
    }

    public function getGraphics(): string {
        return (string) $this->graphics;
    }

    public function getOrder(): int {
        return (int) $this->order;
    }

    public function getStatus(): string {
        return (string) $this->status;
    }

    public function getRelations(): array {
        return $this->relations;
    }
}
