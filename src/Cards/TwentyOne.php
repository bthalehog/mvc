<?php

namespace App\Cards;

use App\Cards\Card;
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

    protected string	$difficulty = "normal";
    protected ?object 	$deck = null;
    protected array 	$players = [];
    protected ?array 	$extra = null;
    protected array 	$cardIndex;
    protected ?object 	$currentPlayer = null;
    protected ?object 	$bank = null;
	protected ?object 	$winner = null;
	protected int 		$currentPlayerIndex = 0;

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

	/**
	 * Sets the variable $game->currentPlayerIndex
	 * to track currentPlayer in turn handler.
     */
	public function setCurrentPlayerIndex($index) {
		$this->currentPlayerIndex = $index;
	}

	/**
	 * Get index of currentPlayer
	 * Returns int index
     */
	public function getCurrentPlayerIndex(): int {
		return $this->currentPlayerIndex;
	}

	/**
	 * Assign deck to game
     */
    public function addDeck($deck = new DeckOfCards('Trad52')) {
        $this->deck = $deck;
    }
    
	/**
	 * Add player to playerlist.
     */
    public function addPlayer($number_of_players=null)
    {
		if ($number_of_players === 100) {
			$bank = new CardHand($this->getDeck(), 0); //ändrat till getDeck()
			$this->setBank($bank);
			return;
		}
		if ($number_of_players !== null) {
			$counter = 0;
			
			while ($counter < $number_of_players) {
				$newPlayer = new CardHand($this->deck, 1);
				$newPlayer->setPlayer($counter);
				array_push($this->players, $newPlayer);
				$counter++;
			};
		} else {
			echo "No amount of players given";
		}
    }

	/**
	 * Set difficulty-level of game.
	 * Currently takes "normal" and "nightmare"
     */
	public function setDifficulty($difficulty_level) {
        if ($difficulty_level === "nightmare") {
            $this->difficulty = "nightmare";
        } else if ($difficulty_level === "normal") {
            $this->difficulty = "normal";
        } else {
            echo "Not a valid option, choose from: normal/nightmare";
        }
    }
    
	/**
	 * Set game stake to $amount (bank-move)
     */
    public function setStake(int $amount)
    {
        $this->stake = $amount;
    }
    
	/**
	 * Get difficulty-level of game.
     */
    public function getDifficulty(): string
    {
        return (string) $this->difficulty;
    }

	/**
	 * Get bank
	 * Returns cardHand-object bank.
     */
	public function getBank(): object
    {
        return (object) $this->bank;
    }
    
	/**
	 * Get deck
	 * Returns deckOfCards-object
     */
    public function getDeck(): object
    {
        return $this->deck;
    }
    
	/**
	 * Get deck as string
	 * Returns string holding deckvalues.
     */
    public function getDeckString(): string
    {
        return (string) $this->deck->asString();
    }

	/**
	 * Get player from playerlist based on index.
	 * Returns cardHand-object or null.
     */    
    public function getPlayer($which_player=1): ?object
    {
		if (count($this->players) === 0) {
			return null;
		}

		if (array_key_exists($which_player, $this->players)) {
			return $this->players[$which_player];
		}
		
		throw new \OutOfBoundsException("Player index {$which_player} not found.");
    }

	/**
	 * Get all players in playerlist
     * Returns array of cardHand-objects (player)
     */
	public function getAllPlayers(): array
    {
		return $this->players ?? null;
    }
    
	/** DECOMMISSIONED
	 * PART OF QUEUE-HANDLER LOGIC
     * Rotate player from player-list to end of list
     */
	public function rotatePlayer($player)
    {
		if ($player !== null) {
			array_push($this->players, $player);
			echo "Added player to end of queue";
		} if ($player->getPlayer() === 1 && $player->isHead() === false) {
			$this->setHead("true");
		}
		
	}

	/** DECOMMISSIONED
	 * PART OF QUEUE-HANDLER LOGIC
     * Pop player from player-list
     */
    public function popPlayer() {
		array_shift($this->players);
		$this->addFlash('notice', "Removed first in queue");
	}
    
    public function getStake(): int
    {
        return (int) $this->stake;
    }
    
    public function getCurrentPlayer(): ?object
    {	
        return $this->currentPlayer;
    }

	public function setCurrentPlayer($newCurrent)
    {	
        $this->currentPlayer = $newCurrent;
    }
    
	/**
     * Handles the first turn in a game
	 * Assigning currentPlayer
	 * Selecting bank
	 * Adjusting playerlist.
     */
	public function firstTurn() {
		// This should pop and append like a queue but track final.
		if ($this->currentPlayer === null) 
		{
			// This will shift from players -> bank and leave the players diminished.
			$this->setBank($this->getPlayer(0));

			// The new index zero will be first currentPlayer()		
			$this->currentPlayer = $this->getPlayer();
		
			$moveToBack = $this->getPlayer(0);
			$this->popPlayer();
			$this->setCurrentPlayer = $this->getPlayer(0);
			$this->rotatePlayer($moveToBack);
		}
	}

	/** DECOMMISSIONED (replaced by nextPlayer in new game flow structure)
     * Handles turn in player queue
     */
    public function turn() {
		// This should pop and append like a queue but track final.
		if ($this->currentPlayer === null) 
		{
			$this->currentPlayer = $this->getPlayer(0);
		}
		else 
		{	
			$moveToBack = $this->getPlayer(0);
			$this->popPlayer();
			$this->setCurrentPlayer = $this->getPlayer(0);
			$this->rotatePlayer($moveToBack);
		}
	}

	/**
     * Compare the sum of cardvalues of bank and player hand-objects.
	 * HandOne should be bank for the win on draw to work!
	 * Returns hand-object-winner.
     */
	public function compareHands($handOne, $handTwo): object
    {
		$highestScore = [];
		$comparison = [];
		$winner = [];

		if ($handOne->getStatus() !== "fat" && $handTwo->getStatus() !== "fat") {
			array_push($comparison, $handOne);
			array_push($comparison, $handTwo);

			foreach ($comparison as $player) {
				if ($player->getScore() !== 21 && $player->getStatus() !== "fat") {
					$handValue = $player->getHandValue();
					$player->setScore($handValue);
				}
			}

			// Bank takes precedence on draw, bank has to be argument 1
			if ($comparison[0]->getScore() === $comparison[1]->getScore()) {
				$winner = $comparison[0];
				echo "Bank win";
			} else if ($comparison[0]->getScore() > $comparison[1]->getScore()) {
				$winner = $comparison[0];
				echo "Bank win";
			} else {
				$winner = $comparison[1];
				echo "Player win";
			}
		} else {
			if ($handOne->getStatus() !== "fat" && $handTwo->getStatus() === "fat") {
				$winner = $handOne;
				echo "Bank win";
			} elseif ($handTwo->getStatus !== "fat") {
				$winner = $handTwo;
				echo "Bank win";
			}
		}

		return $winner;
    }

	/* public function compareHands(): ?object
    {
		$winnerOfAll = null;
		$highestScore = 0;

		foreach ($this->players as $player) {
			$handValue = $player->getHandValue();
			$player->setScore($handValue);

			if ($handValue > $highestScore && $handValue <= 21) {
				$highestScore = $handValue;
				$winnerOfAll = $player;
			}
		}

		return $winnerOfAll;
    } */
   
	/**
     * Return number of players in playerlist.
     */
	public function playerCount(): int {
		return (int) count($this->players);
	}
	
	/**
     * Find out if the cards on hand constitutes a specialcase for 21.
	 * Returns boolean.
	 * Does NOT alter player status.
     */
	public function is21($hand) {
		$cards = [];
		$aces = 0;
		$suite = 0;
		
		// Write cardvalues to list
		foreach($hand as $card) {
			// Separate int value from cardvalue combo (ex s12).
			$card = preg_replace('/\D/', '', $card->getValue());
			array_push($cards, $card);
		}
		
		// Count number of aces, suites or suite = 2 + value10
		foreach($cards as $card) {
			// Check for Ace
			// If card > len 2 then check card[0] and card[1]
			if ($card === 14) {
				$aces += 1;
			}
			// Check for King, Queen and Jack
			if ($card === 13 or $card === 12 or $card === 11) {
				$suite += 1;
			}
			// Check for combination of two covered and one ace
			if ($suite === 2 && $aces === 1) {
				$suite += 1;
			}
		}	
		
		// Find if any special case condition is true
		if ($aces >= 2) {
			echo "Two or more aces = 21!";
			return true;
		} else if (array_sum($cards) === 21) {
			echo "Sum of cards on hand = 21!";
			return true;
		} else if ($suite === 3) {
			echo "Suite (three covered or two covered and one ace) = 21!";
			return true;
		}
		// This can also be used to alter difficulty on mode-setting.
		// Shift rules into elseif below for separation.
		else if ($this->getDifficulty() === "nightmare") {
			if (count($hand) >= 5) {
				echo "Hand size >= 5 is 21! (specialCase - nightmare-mode)";
				return true;
			}
		} else {
			return false;
		}
	}
	
	/**
     * Set bank
	 * If single-player then new CardHand as bank.
	 * If multi-player then filters out selected from playerlist
	 * and selects as bank. Bank has order nr 99999.
     */
	public function setBank($player=null): object
    {
		$withoutBank = [];
		
		if ($player === null) {
			$this->bank = new CardHand($this->getDeck(), 0);
		} else {
			$withoutBank = array_filter($this->players, fn($item) => $item !== $player);
			$this->players = array_values($withoutBank);
			$this->bank = $player;
			$this->getBank()->setPlayer(99999);
		}

		return $this->bank;
    }
    
	// Also in DeckOfCards
	/**
     * Deal $amount cards.
	 * Return Card-object.
     */
    public function dealCard(int $amount = 1)
    {
        for ($i = 0; $i < $amount; $i++) {
            $randInd = array_rand($this->getDeck());
            $dealtCard = $this->getDeck()[$randInd];
            unset($this->getDeck()[$randInd]);
        }

        return $dealtCard;
    }
	
	// Also in DeckOfCards
	/**
     * Shuffle deck.
     */
    public function shuffleDeck(): object
    {
        $carrier = $this->deck;
        shuffle($carrier);
        $this->deck = $carrier;

        return $this;
    }
	
	// Also in DeckOfCards
	/**
     * JsonSerializer for $deck
     */
    public function jsonSerialize(): mixed
    {
        return $this->deck->getDeck();
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

	public function getWinner(): null {
		foreach($this->getAllPlayers() as $player) {
			if ($player->getStatus() === "winner") {
				return $player;
			}
		}
	}

	// ------- GAME LOGIC FUNCTIONS ---------

	/**
     * Instructions for game
	 * Returns instructions for game
     */
    public static function getRules(): string
    {	
		$rules = '<article class="rules">
                <h2>Tjugo-ett</h2>
                    <p>Spelets idé är att med två eller flera kort försöka uppnå det sammanlagda värdet 21, eller komma<br>
                    så nära som möjligt utan att bli "tjock", det vill säga - överskrida 21.</p>
                    <ul>
                        <li>En av spelarna utses till bankir.</li>
                        <li>Om antalet spelare är 1 spelar denne mot datorstyrd bank.
                        <li>Bankiren i tjugoett spelar mot en spelare i taget.</li>
                        <li>Essen är värda valfritt 1 eller 14, kungarna 13, damerna 12, knektarna 11.</li>
                        <li>Nummerkorten har samma värden som valören.</li>
                        <li>Två eller fler ess samt två klädda kort och ett ess innebär 21.</li>
                        <li>Om en spelare lyckas dra fem kort utan att bli tjock anses denne ha nått 21.</li>
                        <li>Om det sammanlagda värdet på korten överskrider 21 är spelaren/banken "tjock" och får inga poäng.</li>
                        <li>Banken vinner ALLTID vid lika.</li>
                        <li>Den spelare som vid spelets slut lyckats vinna mot banken och har högst poäng vinner.</li>
                        <li>Skulle flera spelare ha samma poäng delas förstaplatsen.</li>
                    </ul>
                <h4>Specialfall</h4>
                <p><i>Tillämpas tillsammans med smartare AI vid "nightmare"-difficulty.</i></p>
                    <ul>
                        <li>Två, eller tre, ess utan andra kort får räknas som 21</li>
                        <li>En spelare som fått fem kort utan att spricka anses ha uppnått 21</li>
                    </ul>
            </article>';

		return $rules;
    }

	/**
     * Turn handler
	 * Shifts to next player in $game->players
	 * Increases $this->currentPlayerIndex
     */
	public function nextPlayer(): void {
		if ($this->currentPlayerIndex + 1 < count($this->players)) {
			$this->currentPlayerIndex++;
			$this->currentPlayer = $this->players[$this->currentPlayerIndex];
		}
	}

	/**
     * Check if last player
	 * Returns bool
     */
	public function lastPlayer(): bool {
		return $this->currentPlayerIndex >= count($this->players) - 1;
	}

	/**
     * Logic for player move (unused)
     */
	public function playerMove() {
		return $this->deck->dealCard(1);
	}

	/**
     * Banklogic for multiplayer game
	 * Lets selected player act as bank.
     */
    public static function bankMove($game, SessionInterface $session, Request $request): object
	{
		$action = $request->request->get('action');

		while ($game->getBank()->getHandValue() < 21 || $game->getBank()->getStatus() !== "happy" || $game->getBank()->getStatus() !== "winner") {
			if ($action = "draw") {
				// Check if combination is 21
				$game->getBank()->cardToHand(1, $game->getDeck());
				$game->addFlash('notice', "Bank draws!");

				if ($game->is21($game->getBank()->getHand()) === true){
					$game->addFlash('notice', "Bank hits 21!");
					$game->getBank()->setStatus("winner");
					$game->getCurrentPlayer()->setStatus("fat");
				};

				if ($game->getBank()->getHandValue() > 21) {
					// Check for 21-combinations.
					if ($game->is21($game->getBank()->getHand()) === true) {
						$game->addFlash('notice', "Bank hits 21!");
						$game->getBank()->setStatus("winner");
					} else {
						$game->addFlash('notice', "Bank burst!<br>");
						$game->getBank()->setStatus("fat");
						$game->getCurrentPlayer()->setStatus("winner");
					}
				} elseif ($game->getBank()->getHandValue() === 21) {
					$game->addFlash('notice', "Bank hits 21!");
					$game->getBank()->setStatus("winner");
				}
			}

			if ($action === "stay" || $game->getBank()->getHandValue() > 17) {
				$game->addFlash('notice', "Bank stays with hand value: " . (string)$game->getBank()->getHandValue());
				$game->getBank()->setStatus("happy");
			}
		}
		return $game;
	}

	/**
     * Banklogic for single player game
	 * Lets bank act on algorithmic instruction.
     */
    public function bankMoveAI()
	{
		while ($this->getBank()->getHandValue() < 21 && $this->getBank()->getStatus() !== "happy" && $this->getBank()->getStatus() !== "winner") {
			$this->getBank()->cardToHand(1, $this->getDeck());
			
			// This is used to set difficulty level or intelligence, mathematically always intelligent to stay above 17.
			if ($this->getBank()->getHandValue() <= 21) {
				echo "Bank stays!";
				$this->getBank()->setStatus("happy");
			} else if ($this->getBank()->getHandValue() > 21) {
				// Check for 21-combinations.
				if ($this->is21($this->getBank()->getHand())) {
					echo "Bank hits 21!";
					$this->getBank()->setStatus("winner");
				} else {
					echo "Bank burst!";
					$this->getBank()->setStatus("fat");
					$this->getCurrentPlayer()->setStatus("winner");
				}
			} else if ($this->getBank()->getHandValue() === 21) {
				$this->getBank()->setStatus("winner");
				$this->addFlash('notice', "Bank hits 21!");
			}
		}
	}

	/**
     * Banklogic ACTIVE
	 * Auto-pull until 17.
     */
    public function autoPull()  {
		while ($this->getBank()->getHandValue() < 17) {
			echo "Bank below 17, has to draw!";

			$this->getBank()->cardToHand(1, $this->getDeck());

			if ($this->getBank()->getHandValue() >= 17) {
				if ($this->getBank()->getHandValue() === 21) {
					echo "Bank hits 21!";
					$this->getBank()->setStatus("winner");
					$this->getCurrentPlayer()->setStatus("fat");
				} elseif ($this->is21($this->getBank()->getHand()) === true) {
					echo "Bank hits 21!";
					$this->getBank()->setStatus("winner");
					$this->getCurrentPlayer()->setStatus("fat");
				}
			}
		}
	}
	
	/**
     * Determine winner in a game between bank and player
	 * Return void (sets status = "winner")
     */
    public function determineWinner()
	{
		if ($this->getBank()->getStatus() === "winner") {
			$winner = $this->getBank()->getPlayer(); 
			$result = "Bank wins!";
			echo $result;
			$this->getBank()->setWallet($this->getStake());
		} elseif ($this->getCurrentPlayer()->getStatus() === "winner") {
				$winner = $this->getCurrentPlayer()->getPlayer(); //Should return an int
				$result = "Player wins!";
				echo $result;
				$this->getCurrentPlayer()->setWallet($this->getStake());
		} elseif ($this->getCurrentPlayer()->getStatus() === "happy" && $this->getBank()->getStatus() === "fat") {
			$result = $this->getCurrentPlayer()->getPlayerString() . " wins!<br>";
			echo $result;
			$this->getCurrentPlayer()->setWallet($this->getStake());
		} elseif ($this->getCurrentPlayer()->getStatus() === "happy" && $this->getBank()->getStatus() === "happy") {
			echo "Comparing hands...";
			sleep(1);
			$winner =$this->compareHands($this->getBank(), $this->getCurrentPlayer());
			echo "Player" . (string)$winner->getPlayer();

			if ($winner === $this->getBank()) {
				$result = "Bank wins!";
				echo $result;
				$this->getBank()->setWallet($this->getStake());
			} elseif ($winner === $this->getCurrentPlayer()) {
				$result = "Player" . (string)$winner->getPlayer() . " wins!";
				echo $result;
				
				$this->getCurrentPlayer()->setWallet($this->getStake());
				// $game->getPlayer($winner)->setWallet($game->getStake());
				$this->addFlash('notice', "Total earnings: " . (string)$winner->getWallet());
			} else {
				$result = "No winner! Bank takes all.";
				echo $result;
				$this->getBank()->setWallet($this->getStake());
			}
		}
	}

	/* 	STATIC FUNCTIONS (UNUSED or METHODIZED ABOVE) 	*/
	/* 		Takes $game and returns $game				*/

	/**
     * Banklogic
	 * Auto-pull until 17.
     */
    public static function autoPullArg($game): object {
		while ($game->getBank()->getHandValue() < 17) {
			$game->addFlash('notice', "Bank below 17, has to draw!");
			$game->getBank()->cardToHand(1, $game->getDeck());

			if ($game->getBank()->getHandValue() >= 17) {
				if ($game->getBank()->getHandValue() === 21) {
					$game->addFlash('notice', "Bank hits 21!");
					$game->getBank()->setStatus("winner");
					$game->getCurrentPlayer()->setStatus("fat");
				} elseif ($game->is21($game->getBank()->getHand()) === true) {
					$game->addFlash('notice', "Bank hits 21!");
					$game->getBank()->setStatus("winner");
					$game->getCurrentPlayer()->setStatus("fat");
				}
			}
		}
		return $game;
	}

	/**
     * Determines winner in $game
	 * Lets bank act on algorithmic instruction.
     */
    public static function determineWinnerArg($game): object
	{
		if ($game->getBank()->getStatus() === "winner") {
			$winner = $game->getBank()->getPlayer(); //Should return an int
			$result = "Bank wins!";
			$game->addFlash('notice', $result);
			$game->getBank()->setWallet($game->getStake());
		} elseif ($game->getCurrentPlayer()->getStatus() === "winner") {
				$winner = $game->getCurrentPlayer()->getPlayer(); //Should return an int
				$result = "Player wins!";
				$game->addFlash('notice', $result);
				$game->getCurrentPlayer()->setWallet($game->getStake());
		} elseif ($game->getCurrentPlayer()->getStatus() === "happy" && $game->getBank()->getStatus() === "fat") {
			$result = $game->getCurrentPlayer()->getPlayerString() . " wins!<br>";
			$game->addFlash('notice', $result);
			$game->getCurrentPlayer()->setWallet($game->getStake());
		} elseif ($game->getCurrentPlayer()->getStatus() === "happy" && $game->getBank()->getStatus() === "happy") {
			$game->addFlash('notice', "Comparing hands...");
			sleep(1);
			$winner = $game->compareHands($game->getBank(), $game->getCurrentPlayer());
			$game->addFlash('notice', "Player" . (string)$winner->getPlayer());

			if ($winner === $game->getBank()) {
				$result = "Bank wins!";
				$game->addFlash('notice', $result);
				$game->getBank()->setWallet($game->getStake());
			} elseif ($winner === $game->getCurrentPlayer()) {
				$result = "Player" . (string)$winner->getPlayer() . " wins!";
				$game->addFlash('notice', $result);
				
				$game->getCurrentPlayer()->setWallet($game->getStake());
				// $game->getPlayer($winner)->setWallet($game->getStake());
				$game->addFlash('notice', "Total earnings: " . (string)$winner->getWallet());
			} else {
				$result = "No winner! Bank takes all.";
				$game->addFlash('notice', $result);
				$game->getBank()->setWallet($game->getStake());
			}
		}
		return $game;
	}
}

/** {{ path('play') }} */
