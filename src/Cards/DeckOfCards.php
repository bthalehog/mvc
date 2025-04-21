<?php

namespace App\Cards;

// require_once(__DIR__ . '/Card.php');

use App\Cards\Card; // Import specific class

// Keep all complezity in deckofcards, let card be simple, cardhand simple.
// Added decks() for selecting between jokers or no jokers, prepped to be extended.
// 

/**
 * CardHand-class
 * Holds Card-objects for playing card game.
 */
class DeckOfCards
{
    /**
     * @var array $deck             Holding all the (remaining) cards of the deck.
     * @var integer $deckSize       Defining the size of the deck used (better as tuple?).
     * @var string $deckType        Defining the type of deck used.
     * @var array $lastDraw         Holding the last cards drawn (also writes draws to histogram).
     * @var array $lastDeal         Holding the last cards dealt (also writes draws to histogram).
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
        echo $this->deckType . "\n";

        $this->deckMap = $this->decks($this->deckType);

        print_r($this->deckMap);
        
        // Set deck size by count
        $this->deckSize = count($this->deckMap);
        echo ((string) $this->deckSize) . "\n";;

        // Card should be given value from DoC->cardInd, therefore randSelect inside this loop.
        while (count($this->deckMap) > 0) {
        // for ($i = 0; $i <= ($this->deckSize + 1); $i++) {
            // Selection from cardIndex
            $randSelector = array_rand($this->deckMap);
            //$this->value = $this->cardIndex[$randSelector]["value"]; // "value" instead? "value"=>"s1" or better to pop?
            // $this->cardIndex[$randSelector]["status"] = "out";
            // FIX THIS - $this->lastDraw = $this->value;
            // OPTION $this->addToHistogram($this->lastDraw);
            array_push($this->deck, new Card($this->deckMap[$randSelector]["value"] ?? null));
            unset($this->deckMap[$randSelector]);
        }

        echo "Created deck \n";
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

    // Decide whether it deals one card and is called repeatedly or if it takes argument and repeats call inside.
    public function dealCard(int $amount = 1)
    {
        for ($i=0; $i < $amount; $i++) {
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

    public function getDeck(): array {
        return $this->deck;
    }

    public function getSize(): int {
        return count($this->deck);
    }

    public function getType(): string {
        return (string) $this->deckType;
    }

    public function decks(string $type = 'Trad52'): array {    
        $decks = [
            "Trad52" => [
                ["value" => "s1", "status" => "in"], ["value" => "s2", "status" => "in"], ["value" => "s3", "status" => "in"], ["value" => "s4", "status" => "in"], ["value" => "s5", "status" => "in"], ["value" => "s6", "status" => "in"], ["value" => "s7", "status" => "in"], ["value" => "s8", "status" => "in"], ["value" => "s9", "status" => "in"], ["value" => "s10", "status" => "in"], ["value" => "s11", "status" => "in"], ["value" => "s12", "status" => "in"], ["value" => "s13", "status" => "in"],
                ["value" => "c1", "status" => "in"], ["value" => "c2", "status" => "in"], ["value" => "c3", "status" => "in"], ["value" => "c4", "status" => "in"], ["value" => "c5", "status" => "in"], ["value" => "c6", "status" => "in"], ["value" => "c7", "status" => "in"], ["value" => "c8", "status" => "in"], ["value" => "c9", "status" => "in"], ["value" => "c10", "status" => "in"], ["value" => "c11", "status" => "in"], ["value" => "c12", "status" => "in"], ["value" => "c13", "status" => "in"],
                ["value" => "d1", "status" => "in"], ["value" => "d2", "status" => "in"], ["value" => "d3", "status" => "in"], ["value" => "d4", "status" => "in"], ["value" => "d5", "status" => "in"], ["value" => "d6", "status" => "in"], ["value" => "d7", "status" => "in"], ["value" => "d8", "status" => "in"], ["value" => "d9", "status" => "in"], ["value" => "d10", "status" => "in"], ["value" => "d11", "status" => "in"], ["value" => "d12", "status" => "in"], ["value" => "d13", "status" => "in"],
                ["value" => "h1", "status" => "in"], ["value" => "h2", "status" => "in"], ["value" => "h3", "status" => "in"], ["value" => "h4", "status" => "in"], ["value" => "h5", "status" => "in"], ["value" => "h6", "status" => "in"], ["value" => "h7", "status" => "in"], ["value" => "h8", "status" => "in"], ["value" => "h9", "status" => "in"], ["value" => "h10", "status" => "in"], ["value" => "h11", "status" => "in"], ["value" => "h12", "status" => "in"], ["value" => "h13", "status" => "in"]
            ],
            "Trad54" => [
                ["value" => "s1", "status" => "in"], ["value" => "s2", "status" => "in"], ["value" => "s3", "status" => "in"], ["value" => "s4", "status" => "in"], ["value" => "s5", "status" => "in"], ["value" => "s6", "status" => "in"], ["value" => "s7", "status" => "in"], ["value" => "s8", "status" => "in"], ["value" => "s9", "status" => "in"], ["value" => "s10", "status" => "in"], ["value" => "s11", "status" => "in"], ["value" => "s12", "status" => "in"], ["value" => "s13", "status" => "in"],
                ["value" => "c1", "status" => "in"], ["value" => "c2", "status" => "in"], ["value" => "c3", "status" => "in"], ["value" => "c4", "status" => "in"], ["value" => "c5", "status" => "in"], ["value" => "c6", "status" => "in"], ["value" => "c7", "status" => "in"], ["value" => "c8", "status" => "in"], ["value" => "c9", "status" => "in"], ["value" => "c10", "status" => "in"], ["value" => "c11", "status" => "in"], ["value" => "c12", "status" => "in"], ["value" => "c13", "status" => "in"],
                ["value" => "d1", "status" => "in"], ["value" => "d2", "status" => "in"], ["value" => "d3", "status" => "in"], ["value" => "d4", "status" => "in"], ["value" => "d5", "status" => "in"], ["value" => "d6", "status" => "in"], ["value" => "d7", "status" => "in"], ["value" => "d8", "status" => "in"], ["value" => "d9", "status" => "in"], ["value" => "d10", "status" => "in"], ["value" => "d11", "status" => "in"], ["value" => "d12", "status" => "in"], ["value" => "d13", "status" => "in"],
                ["value" => "h1", "status" => "in"], ["value" => "h2", "status" => "in"], ["value" => "h3", "status" => "in"], ["value" => "h4", "status" => "in"], ["value" => "h5", "status" => "in"], ["value" => "h6", "status" => "in"], ["value" => "h7", "status" => "in"], ["value" => "h8", "status" => "in"], ["value" => "h9", "status" => "in"], ["value" => "h10", "status" => "in"], ["value" => "h11", "status" => "in"], ["value" => "h12", "status" => "in"], ["value" => "h13", "status" => "in"],
                ["value" => "joker1", "status" => "in"], ["value" => "joker2", "status" => "in"]]
        ];
    
        echo "Available deck types: 'Trad52', 'Trad54' \n";
    
        if (array_key_exists($type, $decks)) {
            echo "You selected: $type \n";
            return (array) $decks[$type];
        } else {
            echo "No such deck type.";
        }
    }
}
