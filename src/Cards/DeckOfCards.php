<?php

namespace App\Cards;

use App\Cards\Card; // Import specific class

// Keep all complexity in deckofcards, let card be simple, cardhand simple.
// Added decks() for selecting between jokers or no jokers, prepped to be extended.

/**
 * DeckOfCards-object
 * Creates DeckOfCards-object for use in card games.
 */
class DeckOfCards implements \JsonSerializable
{
    /**
     * @var array $deck             Holding all the (remaining) cards of the deck.
     * @var integer $deckSize       Defining the size of the deck used (better as tuple?).
     * @var string $deckType        Defining the type of deck used.
     * @var array $lastDraw         Holding the last cards drawn (also writes draws to histogram).
     * @var array $lastDeal         Holding the last cards dealt (also writes draws to histogram).
     * @var array $deckMap          Indexer for conversion.
     */
    protected array $deck = [];
    protected ?int $deckSize = null;
    protected array $lastDraw = [];
    protected array $lastDeal = [];
    protected string $deckType;
    protected array $deckMap;

    /**
     * Constructor to create a deck of $deckType.
     */
    public function __construct($deckType)
    {
        $this->deckType = $deckType;
        // echo $this->deckType . "\n";

        $this->deckMap = $this->decks($this->deckType);

        // print_r($this->deckMap);

        // Set deck size by count
        $this->deckSize = count($this->deckMap);
        // echo ((string) $this->deckSize) . "\n";;

        // Card should be given value from DoC->cardInd, therefore randSelect inside this loop.

        while (count($this->deckMap) > 0) {
            // for ($i = 0; $i <= ($this->deckSize + 1); $i++) {
            // Selection from cardIndex
            $randSelector = array_rand($this->deckMap);
            //$this->value = $this->cardIndex[$randSelector]["value"]; // "value" instead? "value"=>"s1" or better to pop?
            // $this->cardIndex[$randSelector]["status"] = "out";
            // FIX THIS - $this->lastDraw = $this->value;
            // OPTION $this->addToHistogram($this->lastDraw);
            array_push($this->deck, new Card($this->deckMap[$randSelector]["value"] ?? null, $this->deckMap[$randSelector]["status"] ?? null, $this->deckMap[$randSelector]["order"] ?? null));
            unset($this->deckMap[$randSelector]);
        }

        // echo "Created deck \n";
    }

    public function asString(): string
    {
        $carrier = "";

        foreach ($this->deck as $card) {
            $carrier .= ($card->getValue() . ", ");
            // echo $carrier;
        }

        $carrier = rtrim($carrier, ", ");

        return (string) $carrier;
    }

    public function asCards(): string
    {
        $carrier = "";

        foreach ($this->deck as $card) {
            $carrier .= ($card->getGraphics() . " ");
            // echo $carrier;
        }

        $carrier = rtrim($carrier, ", ");

        return (string) $carrier;
    }

    // Decide whether it deals one card and is called repeatedly or if it takes argument and repeats call inside.
    public function dealCard(int $amount = 1)
    {
        for ($i = 0; $i < $amount; $i++) {
            $randInd = array_rand($this->deck);
            $dealtCard = $this->deck[$randInd];
            array_push($this->lastDeal, $dealtCard);
            unset($this->deck[$randInd]);
            $this->deckSize = count($this->deck);
        }

        return $dealtCard;
    }

    public function getLastDeal(): array
    {
        return $this->lastDeal;
    }

    public function getDeck(): array
    {
        return $this->deck;
    }

    public function getSize(): int
    {
        return count($this->deck);
    }

    public function getType(): string
    {
        return (string) $this->deckType;
    }

    public function sortDeck(int $order = 1): object
    {
        $carrier = $this->deck;

        // Use ($order) removed / from arg- int $order = 1
        usort($carrier, function ($alfa, $beta) {
            // return $a['order'] <=> $b['order'];
            return $alfa->getOrder() <=> $beta->getOrder();
        });

        $this->deck = $carrier;

        return $this;
    }

    public function shuffleDeck(): object
    {
        $carrier = $this->deck;

        shuffle($carrier);

        $this->deck = $carrier;

        return $this;
    }

    public function findByOrder($order): object
    {
        $specific = new Card();

        foreach ($this->deck as $card) {
            if ($card->getOrder() == $order) {
                $specific = $card;
            }
        }

        return (object) $specific;
    }

    public function decks(string $type = 'Trad52'): array
    {
        $decks = [
            "Trad52" => [
                ["order" => 1, "value" => "s1", "status" => "🂡"], ["order" => 2, "value" => "s2", "status" => "🂢"], ["order" => 3, "value" => "s3", "status" => "🂣"], ["order" => 4, "value" => "s4", "status" => "🂤"], ["order" => 5, "value" => "s5", "status" => "🂥"], ["order" => 6, "value" => "s6", "status" => "🂦"], ["order" => 7, "value" => "s7", "status" => "🂧"], ["order" => 8, "value" => "s8", "status" => "🂨"], ["order" => 9, "value" => "s9", "status" => "🂩"], ["order" => 10, "value" => "s10", "status" => "🂪"], ["order" => 11, "value" => "s11", "status" => "🂫"], ["order" => 12, "value" => "s12", "status" => "🂭"], ["order" => 13, "value" => "s13", "status" => "🂮"],
                ["order" => 14, "value" => "c1", "status" => "🃑"], ["order" => 15, "value" => "c2", "status" => "🃒"], ["order" => 16, "value" => "c3", "status" => "🃓"], ["order" => 17, "value" => "c4", "status" => "🃔"], ["order" => 18, "value" => "c5", "status" => "🃕"], ["order" => 19, "value" => "c6", "status" => "🃖"], ["order" => 20, "value" => "c7", "status" => "🃗"], ["order" => 21, "value" => "c8", "status" => "🃘"], ["order" => 22, "value" => "c9", "status" => "🃙"], ["order" => 23, "value" => "c10", "status" => "🃚"], ["order" => 24, "value" => "c11", "status" => "🃛"], ["order" => 25, "value" => "c12", "status" => "🃝"], ["order" => 26, "value" => "c13", "status" => "🃞"],
                ["order" => 27, "value" => "d1", "status" => "🃁"], ["order" => 28, "value" => "d2", "status" => "🃂"], ["order" => 29, "value" => "d3", "status" => "🃃"], ["order" => 30, "value" => "d4", "status" => "🃄"], ["order" => 31, "value" => "d5", "status" => "🃅"], ["order" => 32, "value" => "d6", "status" => "🃆"], ["order" => 33, "value" => "d7", "status" => "🃇"], ["order" => 34, "value" => "d8", "status" => "🃈"], ["order" => 35, "value" => "d9", "status" => "🃉"], ["order" => 36, "value" => "d10", "status" => "🃊"], ["order" => 37, "value" => "d11", "status" => "🃋"], ["order" => 38, "value" => "d12", "status" => "🃍"], ["order" => 39, "value" => "d13", "status" => "🃎"],
                ["order" => 40, "value" => "h1", "status" => "🂱"], ["order" => 41, "value" => "h2", "status" => "🂲"], ["order" => 42, "value" => "h3", "status" => "🂳"], ["order" => 43, "value" => "h4", "status" => "🂴"], ["order" => 44, "value" => "h5", "status" => "🂵"], ["order" => 45, "value" => "h6", "status" => "🂶"], ["order" => 46, "value" => "h7", "status" => "🂷"], ["order" => 47, "value" => "h8", "status" => "🂸"], ["order" => 48, "value" => "h9", "status" => "🂹"], ["order" => 49, "value" => "h10", "status" => "🂺"], ["order" => 50, "value" => "h11", "status" => "🂻"], ["order" => 51, "value" => "h12", "status" => "🂽"], ["order" => 52, "value" => "h13", "status" => "🂾"]
            ],
            "Trad54" => [
                ["order" => 1, "value" => "s1", "status" => "🂡"], ["order" => 2, "value" => "s2", "status" => "🂢"], ["order" => 3, "value" => "s3", "status" => "🂣"], ["order" => 4, "value" => "s4", "status" => "🂤"], ["order" => 5, "value" => "s5", "status" => "🂥"], ["order" => 6, "value" => "s6", "status" => "🂦"], ["order" => 7, "value" => "s7", "status" => "🂧"], ["order" => 8, "value" => "s8", "status" => "🂨"], ["order" => 9, "value" => "s9", "status" => "🂩"], ["order" => 10, "value" => "s10", "status" => "🂪"], ["order" => 11, "value" => "s11", "status" => "🂫"], ["order" => 12, "value" => "s12", "status" => "🂭"], ["order" => 13, "value" => "s13", "status" => "🂮"],
                ["order" => 14, "value" => "c1", "status" => "🃑"], ["order" => 15, "value" => "c2", "status" => "🃒"], ["order" => 16, "value" => "c3", "status" => "🃓"], ["order" => 17, "value" => "c4", "status" => "🃔"], ["order" => 18, "value" => "c5", "status" => "🃕"], ["order" => 19, "value" => "c6", "status" => "🃖"], ["order" => 20, "value" => "c7", "status" => "🃗"], ["order" => 21, "value" => "c8", "status" => "🃘"], ["order" => 22, "value" => "c9", "status" => "🃙"], ["order" => 23, "value" => "c10", "status" => "🃚"], ["order" => 24, "value" => "c11", "status" => "🃛"], ["order" => 25, "value" => "c12", "status" => "🃝"], ["order" => 26, "value" => "c13", "status" => "🃞"],
                ["order" => 27, "value" => "d1", "status" => "🃁"], ["order" => 28, "value" => "d2", "status" => "🃂"], ["order" => 29, "value" => "d3", "status" => "🃃"], ["order" => 30, "value" => "d4", "status" => "🃄"], ["order" => 31, "value" => "d5", "status" => "🃅"], ["order" => 32, "value" => "d6", "status" => "🃆"], ["order" => 33, "value" => "d7", "status" => "🃇"], ["order" => 34, "value" => "d8", "status" => "🃈"], ["order" => 35, "value" => "d9", "status" => "🃉"], ["order" => 36, "value" => "d10", "status" => "🃊"], ["order" => 37, "value" => "d11", "status" => "🃋"], ["order" => 38, "value" => "d12", "status" => "🃍"], ["order" => 39, "value" => "d13", "status" => "🃎"],
                ["order" => 40, "value" => "h1", "status" => "🂱"], ["order" => 41, "value" => "h2", "status" => "🂲"], ["order" => 42, "value" => "h3", "status" => "🂳"], ["order" => 43, "value" => "h4", "status" => "🂴"], ["order" => 44, "value" => "h5", "status" => "🂵"], ["order" => 45, "value" => "h6", "status" => "🂶"], ["order" => 46, "value" => "h7", "status" => "🂷"], ["order" => 47, "value" => "h8", "status" => "🂸"], ["order" => 48, "value" => "h9", "status" => "🂹"], ["order" => 49, "value" => "h10", "status" => "🂺"], ["order" => 50, "value" => "h11", "status" => "🂻"], ["order" => 51, "value" => "h12", "status" => "🂽"], ["order" => 52, "value" => "h13", "status" => "🂾"],
                ["order" => 53, "value" => "joker1", "status" => "🃟"], ["order" => 54, "value" => "joker2", "status" => "🃏"]]
        ];

        // echo "Available deck types: 'Trad52', 'Trad54' \n";

        if (array_key_exists($type, $decks)) {
            // echo "You selected: $type \n";
            return (array) $decks[$type];
        } else {
            echo "No such deck type.";
        }
    }

    public function jsonSerialize(): mixed
    {
        return $this->getDeck(); // or however you want to expose it
    }
}
