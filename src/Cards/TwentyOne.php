<?php

namespace App\Cards;

use App\Cards\Card; // Import specific class
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

// Aimed to make all access to everything encapsulated.
// Base functionality working.
// Can use specialCases in "nightmare" mode.
// AI through likeliness-of-win-manipulation algoritm in "nightmare" mode.
// Implement flowchart.

/**
 * TwentyOne-class
 * Game-object to play the card game Twenty-one.
 */
class TwentyOne implements \JsonSerializable
{
    /**
     * @var string $difficulty      Showing difficulty-level chosen.
     * @var object $deck            Holding the deck-object used to play the game.
     * @var array $players          Holding current players.
     * @var object $extra           Holding the deck-object used to play the game.
     * @var object $cardIndex       Holding the deck-object used to play the game.
     * @var object $currentPlayer   Holding the currentPlayer to take turn (uses queue via turn()).
     * @var object $bank            Holding the player-object selected as bank.
     */

    protected string $difficulty = "normal";
    protected ?object $deck = null;
    protected array $players = [];
    protected ?array $extra = null;
    protected array $cardIndex;
    protected ?object $currentPlayer = null;
    protected ?object $bank = null;

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

	public function getBank(): object
    {
        return (object) $this->bank;
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

	/**
     * Happy no happy?
	 * Returns boolean indicating if calling entity is content with cards.
     */
    public function getStatus(): string
    {	
		return $this->status;
    }
}
