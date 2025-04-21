<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * Acting as controller for testing classes for cardgame.
 */

use App\Cards\DeckOfCards;
use App\Cards\CardHand;
use App\Cards\Card;

$myDeck = new DeckOfCards(52);
$myHand = new CardHand(3);

echo "You have a new deck! ";
echo " Deck: " . $myDeck->asString();

echo " Deal a hand from deck of cards: ";
echo " Hand has: " . (string) $myHand->handSize . " cards.";

echo " Cards on hand: " . (string) $myHand->asString();

// echo "Hand: " . (string) $myHand->asString();

// Skapar kortlek med dubbletter, se till att poppa i card.
