<?php

namespace App\Proj;

/**
 * Handles game state presistency
 */
class StorageHandler
{
    private static string $saveFile = __DIR__ . '/data/save/storageHandler.json';

    public function __construct(string $file = 'storageHandler.json')
    {
        $saveDir = __DIR__ . '/data/save/';

        if (!is_dir($saveDir)) {
            mkdir($saveDir, 0775, true); // 0775 for webserver access (0777 for all full)
        }

        self::$saveFile = $saveDir . $file; // Need file here not saveFile
    }

    // Save all data
    // Should hold room, inventory and actions taken (doors open etc) playe rnot needed since always one
    public static function saveGameData($room, $inventory)
    {   
        $gameData = [
            'room' => $room,
            'inventory' => $inventory
        ];

        return file_put_contents(self::$saveFile, json_encode($gameData, JSON_PRETTY_PRINT));
    }

    // Get all data
    public static function getGameData(): array
    {
        if (!file_exists(self::$saveFile))
        {
            return []; // Reroute to start to generate storage basic setup
        }

        $gameData = file_get_contents(self::$saveFile);
        $decodedData = json_decode($gameData, true);

        return $decodedData;
    }

    // Get inventory from storage
    public static function getInventoryFromStorage(): object
    {
        $gameData = self::getGameData();

        // Find inventory part
        $inventoryData = $gameData['inventory'] ?? [];

        return new Inventory($inventoryData);
    }

    // Set item to local storage
    public static function setItem($key, $value): bool
    {
        $game = self::getGameData();
        $game[$key] = $value;

        return self::saveGameData($game) !== false;
    }

    // Get item from local storage
    public function getItem($key)
    {
        $game = self::getGameData();

        return $game[$key];
    }

    // Remove item from local storage
    public static function removeItem($key): bool
    {
        $game = self::$getGameData();
        unset($game[$key]);

        return self::saveGameData($game) !== false;
    }

    // Clear local storage
    public function clearStorage(): bool
    {
        $game = [];

        return self::saveGameData($game);
    }
}
