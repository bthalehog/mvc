<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * Acting as controller for testing classes for cardgame.
 */

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

// Move call into DeckOf Cards
// $selectedDeck = Decks('Trad52');
// echo $selectedDeck;
$myDeck = new DeckOfCards('Trad52');
// $myHand = new CardHand(3);

echo "You have a new deck! \n";
echo "Decktype: " . $myDeck->getType() . "\n";
echo "Deck: " . $myDeck->asString() . "\n";

$deal = $myDeck->dealCard();

print_r($deal);
echo $deal->getValue() . "\n";
echo $deal->getStatus() . "\n";
print_r($deal->getRelations()) . "\n";

$myHand = new CardHand(3, $myDeck);

print_r($myHand->getHand());

echo "Deck after dealing: " . $myDeck->asString() . "\n";
echo "Deck total: " . (string) $myDeck->getSize() . "\n";


// echo " Deal a hand from deck of cards: ";
// echo " Hand has: " . (string) $myHand->handSize . " cards.";

// echo " Cards on hand: " . (string) $myHand->asString();

// echo "Hand: " . (string) $myHand->asString();

// Skapar kortlek med dubbletter, se till att poppa i card.
