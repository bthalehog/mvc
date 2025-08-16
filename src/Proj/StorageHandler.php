<?php

namespace App\Proj;

/**
 * Handles game state presistency
 */
class StorageHandler
{
    private string $saveFile;

    public function __construct(string $file = 'storageHandler.json')
    {
        $this->saveFile = __DIR__ . '/data/save/' . $saveFile;
    }

    // Save all data
    public function saveGameData(): array
    {
        return file_put_contents($this->saveFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    // Get all data
    public function getGameData(): array
    {
        if (!file_exists($this->saveFile))
        {
            return []; // Reroute to start to generate storage basic setup
        }

        $gameData = file_get_contents($this->storageFile);
        $decodedData = json_decode($content, true);

        return $decodedData;
    }

    // Set item to local storage
    public function setItem($key, $value): bool
    {
        $game = $this->getGameData();
        $game[$key] = $value;

        return $this->saveGame($game);
    }

    // Get item from local storage
    public function getItem($key): bool
    {
        $game = $this->getGameData();

        return $game[$key];
    }

    // Remove item from local storage
    public function removeItem($key): bool
    {
        $game = $this->getGameData();
        $game[$key] = null;

        return $this->saveGame($game);
    }

    // Clear local storage
    public function clearStorage(): bool
    {
        $game = null;

        return $this->saveGame($game);
    }
}
