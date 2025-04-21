<?php 

namespace App\Cards;

function Decks($type = 'Trad52') {
    $deckType = $type;

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

    echo "Available deck types: 'Trad52', 'Trad54'\n";
    echo "Select a deck type: \n";

    if (array_key_exists($type, $decks)) {
        echo "You selected: $type \n";
        return $decks[$type];
    }
}

Decks();
