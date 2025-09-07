<?php

namespace App\Proj;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Handles game state persistency
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
    
        // Added for save state database (copy from json to storage)
        $this->initializeDatabase();
    }

    /**
     * Initialize database by assigning from json to savefile.
     * @return void
     */
    private function initializeDatabase(): void {
        $gameData = self::getGameData();

        // Check for database existance
        if (!isset($gameData['database'])) {
            $jsonPath = __DIR__ . '/data/database/game_rooms.json';

            if (file_exists($jsonPath)) {
                $database = json_decode(file_get_contents($jsonPath), true);                
                self::saveGameData(null, null, null, $database);
            }
        }
    }

    /**
     * Save game data.
     * @return bool from file_put_contents
     */
    public static function saveGameData($room = null, $inventory = null, $objectStates = null, $database = null): bool
    {   
        $gameData = self::getGameData();

        if ($room !== null) {
            $gameData['room'] = $room;
        }

        if ($inventory !== null) {
            $gameData['inventory'] = [
                'items' => $inventory->getAllItems(),
                'selectedItem' => $inventory->getSelectedItem()
            ];
        }

        if ($objectStates !== null) {
            $gameData['objectStates'] = $objectStates;
        }

        if ($database !== null) {
            $gameData['database'] = $database;
        }

        return file_put_contents(self::$saveFile, json_encode($gameData, JSON_PRETTY_PRINT));
    }

    // Might not need this after saving database to file
    /**
     * Get all game data.
     * @return array of decoded database-data
     */
    public static function getGameData(): array
    {
        if (!file_exists(self::$saveFile))
        {
            return []; // Reroute to start to generate storage basic setup
        }

        $gameData = file_get_contents(self::$saveFile);
        $decodedData = json_decode($gameData, true);

        return $decodedData ?? [];
    }

    /**
     * Get database from storage
     * @return array of decoded database-data
     */
    public static function getDatabaseFromStorage(): array {
        $gameData = self::getGameData();

        return $gameData['database'] ?? [];
    }

    /**
     * Update database in storage
     * @return bool from saveGameData()
     */
    public static function updateDatabaseInStorage($database): bool {
        $gameData = self::getGameData();
        $gameData['database'] = $database;

        $room = $gameData['room'];
        $inventoryData = $gameData['inventory'] ?? ['items' => [], 'selectedItem' => null];
        $inventory = new Inventory($inventoryData['items'] ?? []);

        return self::saveGameData($room, $inventory);
    }

    /**
     * Get inventory from storage.
     * @return object Inventory
     */
    public static function getInventoryFromStorage(): object
    {
        $gameData = self::getGameData();

        // Find inventory part
        $inventoryData = $gameData['inventory'] ?? ['items' => [], 'selectedItem' => null];

        // Recreate inventory
        $newInventory = new Inventory($inventoryData['items'] ?? []);

        // If selected
        if (isset($inventoryData['selectedItem']) && $inventoryData['selectedItem'] !== null) {
            $newInventory->select($inventoryData['selectedItem']['item']);
        }

        return $newInventory;
    }

    /**
     * Get room from storage
     * @return mixed room or null;
     */
    public static function getRoomFromStorage($roomId): mixed
    {
        // Get database
        $database = self::getDatabaseFromStorage();

        // Verify
        if (!isset($database['rooms'])) {
            return null;
        }

        // Find room
        foreach($database['rooms'] as $room) {
            if ($room['id'] === $roomId) {
                return $room;
            }
        }

        return null;
    }

    /**
     * Get room data (not storage file)
     * @return array of roomData;
     */
    public static function getRoomData(): array {
        $gameData = self::getGameData();

        // Find room
        $roomData = $gameData['room'] ?? [];

        return $roomData;
    }

    /**
     * Clear savefile (storage)
     * @return void
     */
    public static function clearSaveFile(): void
    {   
        $storageFile = __DIR__ . '/../Proj/data/save/storageHandler.json';
        
        file_put_contents($storageFile, '{}');
    }

    /**
     * Clear storage
     * @return bool from saveGameData();
     */
    public static function clearStorage(): bool
    {
        $room = [];
        $inventory = new Inventory([]);
        $objectStates = [];
        $database = null;

        return self::saveGameData($room, $inventory, $objectStates, $database) !== false;
    }

    /**
     * Clear cache
     * @return void
     */
    public static function clearCache(): void {
        $cache = new FilesystemAdapter();
        $cache->clear();
    }

    // Remodel to save the inventory to state for use as database

    /**
     * setObjectState
     * @return bool from saveGameData();
     */
    public static function setObjectState($roomId, $itemName, $state) {
        $game = self::getGameData();

        // Set object states
        if (!isset($game['objectStates'])) {
            $game['objectStates']= [];
        }

        $key = "room_{$roomId}_item_{$itemName}";
        $game['objectStates'][$key] = $state;
        
        return self::saveGameData(null, null, $game['objectStates']); // Now update specific part
    }

    /**
     * Get object state
     * @return mixed array or null
     */
    public static function getObjectState($roomId, $itemName): mixed {
        $game = self::getGameData();

        // Set object states
        if (!isset($game['objectStates'])) {
            return null;
        }

        $key = "room_{$roomId}_item_{$itemName}";

        return $game['objectStates']['key'] ?? null;
    }

    /**
     * Set item status
     * @return bool
     */
    public static function setItemStatus($roomId, $itemName, $status): bool {
        // Add a try
        $currentItem = self::getItem($roomId, $itemName);
        $currentItem->status = $status;

        return true;
    }

    /**
     * Get item status
     * @return mixed as string or null
     */
    public static function getItemStatus($roomId, $itemName): mixed {
        $database = self::getDatabaseFromStorage();

        if (!isset($database['rooms'])) {
            return false;
        }

        foreach ($database['rooms'] as $room) {
            if ($room['id'] === $roomId && isset($room['items'])) {
                foreach ($room['items'] as $item) {
                    if ($item['item'] === $itemName) {
                        return $item['status'] ?? 0;
                    }
                }
            }
        }
    }

    /**
     * Find item from storage
     * @return mixed as array of itemData or null
     */
    public static function findItemFromStorage($roomId, $itemName): mixed {
        $database = StorageHandler::getDatabaseFromStorage();

        if(!isset($database['rooms'])) {
            return null;
        }

        foreach ($database['rooms'] as $room) {
            if ($room['id'] === $roomId && isset($room['items'])) {
                foreach ($room['items'] as $itemData) {
                    if ($itemData['item'] === $itemName) {
                        return $itemData;
                    }
                }
            }
        }

        return null;
    }

    /**
     * Check if item is selected
     * @return bool
     */
    public static function isSelected($item): bool {
        // Is this syntax working?
        $inventory = self::getInventoryFromStorage();
        $selected = $inventory->getSelectedItem();
        
        if ($selected && $selected['item'] === $item['item']) {
            return true;  
        }
        
        return false;
    }
}
