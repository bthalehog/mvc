<?php

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
        $this->relations = ["optional" => "arrayform"];
        $this->graphics = $graphics;
        $this->order = $order;
    }

    public function asString(): string
    {
        return (string) $this->value;
    }

    public function getValue(): string
    {
        return (string) $this->value;
    }

    public function getGraphics(): string
    {
        return (string) $this->graphics;
    }

    public function getOrder(): int
    {
        return (int) $this->order;
    }

    public function getStatus(): string
    {
        return (string) $this->status;
    }

    public function getRelations(): array
    {
        return $this->relations;
    }
}

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
     */
    protected array     $currentHand = [];
    private array     $lastDraw = [];
    public ?int      $handSize = null;
    private array     $lastSacrifice = [];
    protected int	$score = 0;

    /**
     * Constructor to create instance of CardHand holding Card-objects.
     */
    public function __construct($currentDeck, int $handSize = 3)
    {
        $this->currentHand = [];
        $this->handSize = $handSize;
        $this->cardToHand($handSize, $currentDeck); // Argument is an object not a list!
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

/**
 * DeckOfCards-object
 * Creates deck-object for playing card game.
 */
class DeckOfCards implements \JsonSerializable
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



/**
 * TwentyOne-class
 * Game-object to play the card game Twenty-one.
 */
class TwentyOne implements \JsonSerializable
{
    /**
     * @var string $difficulty      Showing difficulty-level chosen.
     * @var object $bank            Holding the player-object selected as bank.
     * @var array $players          Holding current players.
     * @var object $deck            Holding the deck-object used to play the game.
     */

    protected string $difficulty = "normal";
    protected ?object $deck = null;
    protected array $players = [];
    protected ?array $extra = null;
    protected array $cardIndex;
    protected ?object $currentPlayer = null;

    /**
     * Constructor to create a game
     */
    public function __construct($deck, $number_of_players, $difficulty)
    {
        $this->setDifficulty($difficulty);
        $this->addDeck($deck);
        $this->addPlayer($number_of_players);
        $this->cardIndex = [
            "A" => [1, 14],
            "K" => 13,
            "Q" => 12,
            "J" => 11
        ];
    }

    public function setDifficulty($difficulty_level) {
        if ($difficulty_level === "nightmare") {
            $this->difficulty = "nightmare";
            echo "Difficulty set to 'nightmare'";
        } else if ($difficulty_level === "normal") {
            $this->difficulty = "normal";
            echo "Difficulty set to 'normal'";
        } else {
            echo "Not a valid option, choose from: normal/nightmare";
        }
    }

    public function addDeck($deck = new DeckOfCards('Trad52')) {
        $this->deck = $deck;
        echo "Deck added";
    }
    
    public function addPlayer($number_of_players=null)
    {
		if ($number_of_players === 100) {
			$bank = new CardHand($this->deck, 0);
			$this->bank = $bank;
		}
		if ($number_of_players !== null) {
			$counter = 0;
			
			while ($counter < $number_of_players) {
				$newPlayer = new CardHand($this->deck, 3);
				array_push($this->players, $newPlayer);
				$counter++;
			};
			echo "Players added";
		} else {
			echo "No amount of players given";
		}
    }
    
    public function rotatePlayer($player)
    {
		if ($player !== null) {
			array_push($this->players, $player);
			echo "Added player to end of queue";
		}
	}
    
    public function setStake(int $amount)
    {
        $this->stake = $amount;

        echo "Stake set to: ";
    }
    
    public function getDifficulty(): string
    {
        return (string) $this->difficulty;
    }
    
    public function getDeck(): object
    {
        return $this->deck;
    }
    
    public function getDeckString(): string
    {
        return (string) $this->deck->asString();
    }
    
    public function getPlayer($which_player=1): object
    {
		if (array_key_exists($which_player, $this->players))
		{
			return $this->players[$which_player] ?? null;
		}
		
		throw new \OutOfBoundsException("Player index {$which_player} not found.");
    }
    
    public function popPlayer() {
		array_shift($this->players);
		echo "Removed first in queue";
	}
    
    public function getStake(): int
    {
        return (int) $this->stake;
    }
    
    public function getCurrentPlayer(): object
    {
        return $this->currentPlayer;
    }
    
    public function turn() {
		
		// This should pop and append like a queue
		if ($this->currentPlayer === null) 
		{
			$this->currentPlayer = $this->players[0];
		}
		else 
		{
			$this->popPlayer();
			$this->currentPlayer = $this->players[0];
			$this->rotatePlayer($this->getCurrentPlayer());
			echo "Next player in turn";
		}
	}

	public function compareHands(): object
    {
		$contenders = [];
		
		foreach($this->players as $player) {
			$currentHand = $player->getHand();
			// echo $player->asCards();
			
			foreach($currentHand as $card) {
				$value = $this->cardValueIndexer($card);
				// echo $value;
				$player->setScore($value);
				// echo "Playerscore: " . $value;
				$contenders[$player->getScore()] = $player;
			}
		}
		
		sort($contenders);
		$winner = $contenders[0];
		$winnerString = $winner->asCards();
		// echo $winnerString;
		
		return (object) $winner;
    }

    public function playerMove() {
		echo "Drew card";
		return $this->deck->drawCard();
	}
	
	public function playerCount(): int {
		return (int) count($this->players);
	}
	
	public function is21($hand) {
		$cards = [];
		$aces = 0;
		$suite = 0;
		
		// Write cardvalues to list
		foreach($hand as $card) {
			array_push($cards, $card);
		}
		
		// Count number of aces
		foreach($cards as $card) {
			if ($card === 21) {
				$aces += 1;
			}
		}
		
		// Count number of aces, suites or suite = 2 + value10
		foreach($cards as $card) {
			if ($card === 14) {
				$suite += 1;
			}
			if ($card === 13 && $card === 12 && $card === 11) {
				$suite += 1;
			}
			if ($suite === 2 && $card === 10) {
				$suite += 1;
			}
		}	
		
		// Find if any condition true
		if ($aces <= 2) {
			echo("Ace");
			return true;
		} else if (sum($cards) === 21) {
			echo("Sum");
			return true;
		} else if ($suite === 3) {
			echo("Suite");
			return true;
		}
		else if ($this->getDifficulty() === "nightmare") {
			if ($hand->handSize() >= 5) {
				echo("HandSize - specialCase");
				return true;
			}
		} else {
			return false;
		}
	}
	
	public function setBank($player=null)
    {
		$withoutBank = [];
		
		if ($player !== null) {
			$this->bank = $this->addPlayer(100);
			echo "Bank set";
		} else {
			$withoutBank = array_filter($this->players, fn($item) => $item !== $player);
			$this->players = array_values($withoutBank);
			$this->bank = $player;
			echo "Player selected as bank";
		}
    }
    
	// Also in DeckOfCards
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
	
	// Also in DeckOfCards
    public function shuffleDeck(): object
    {
        $carrier = $this->deck;
        shuffle($carrier);
        $this->deck = $carrier;

        return $this;
    }
	
	// Also in DeckOfCards
    public function jsonSerialize(): mixed
    {
        return $this->deck->getDeck(); // or however you want to expose it
    }
    
    /**
     * Card value Indexer
     */
    public function cardValueIndexer($card): int
    {
		preg_match('/\d+/', $card->getValue(), $match);
		$number_value = $match[0] ?? null;
		preg_match('/[a-zA-Z]/', $card->getValue(), $match);
		$alpha_value = $match[0] ?? null;
		
		// echo $card->getValue();
		// echo "Alpha: " . $alpha_value;
		// echo "Digi: " . $number_value;
		
		if ($alpha_value !== null) {
			if ($number_value !== null) {
				return $number_value;
			}
		}
	}
}

$deck = null;
$game = null;

$deck = new DeckOfCards('Trad52');
$card = $deck->dealCard();
$game = new TwentyOne($deck, 2, 'nightmare');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>namnlös</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 2.0" />
	<meta charset="UTF-8">
</head>

<body>
	<p>Test start: <?php echo "All running smoothly!"?></p>
	<p>Difficulty: setDifficulty("nightmare"): <?php echo $game->getDifficulty();?></p>
	<p>Get deck: getDeckString() (return deck-object): <?php echo $game->getDeckString();?></p>
	<p>Get value of card: cardValueIndexer(card) (return int): <?php echo $game->cardValueIndexer($card);?></p>
	<p>Get player1: getPlayer(1) (return player object): <?php echo $game->getPlayer(0)->asCards();?></p>
	<p>Get player2: getPlayer(2) (return player object): <?php echo $game->getPlayer(1)->asCards();?></p>
	<p>Compare game players hands: compareHands() (return winner object): <?php echo $game->compareHands()->asCards();?></p>
	<p>Who's turn?: turn(): <?php echo $game->turn();?></p>
	<p><?php echo $game->getCurrentPlayer()->asCards();?> </p>
	<p>Is it 21?: is21(player) (return bool): <?php echo $game->is21($game->getCurrentPlayer());?></p>
	<p>Next player turn: turn(): <?php echo $game->turn();?></p>
	<p>Select banker: setBank(): <?php echo $game->setBank();?></p>
</body>

</html>
