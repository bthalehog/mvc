<?php

namespace App\Proj;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

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
    
        // Added for save state database (copy from json to storage)
        $this->initializeDatabase();
    }

    // Initialize by assigning database from json to savefile
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

    // Save all data
    // Should hold room, inventory, database (added) and actions taken (doors open etc) playe rnot needed since always one
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

        /*
        $gameData = [
            'room' => $room,
            'inventory' => [
                'items' => $inventory->getAllItems(),
                'selectedItem' => $inventory->getSelectedItem()
            ],
            'objectStates' => self::getGameData()['objectStates'] ?? [],
            'database' => self::getGameData()['database'] ?? []
        ];
        */

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

        return $decodedData ?? [];
    }

    // Get database from storage
    public static function getDatabaseFromStorage(): array {
        $gameData = self::getGameData();

        return $gameData['database'] ?? [];
    }

    // Update database in storage
    public static function updateDatabaseInStorage($database): bool {
        $gameData = self::getGameData();
        $gameData['database'] = $database;

        $room = $gameData['room'];
        $inventoryData = $gameData['inventory'] ?? ['items' => [], 'selectedItem' => null];
        $inventory = new Inventory($inventoryData['items'] ?? []);

        return self::saveGameData($room, $inventory);
    }

    // Get inventory from storage
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

    // Update room in gameData (storage)
    public static function updateRoom($room) {
        return self::saveGameData($room);
    }

    // Update inventory in gameData (storage)
    public static function updateInventory($inventory) {
        return self::saveGameData(null, $inventory);
    }

    // Might not need this after saving database to state
    // Update object-states in gameData (storage)
    public static function updateObjectStates($objectStates) {
        return self::saveGameData(null, null, $objectStates);
    }

    // Might not need this after saving database to state
    // Update object-states in gameData (storage)
    public static function updateItemStatus($status) {
        $gameData = self::getGameData();
        $database = self::getDatabaseFromStorage();

        if (!isset($database['rooms'])) {
            return false;
        }

        // Find and update status in database
        foreach ($database['rooms'] as $room) {
            if ($room['id'] == $roomId && isset($room['items'])) {
                foreach ($room['items'] as $item) {
                    $item['status'] = $status;
                    $gameData['database'] = $database;

                    return self::saveGameData(null, null, null); // Save database (handled inside saveGameData)
                }
            }
        }
    }

    // Get room from storage
    public static function getRoomFromStorage($roomId)
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

    // Get room data
    public static function getRoomData() {
        $gameData = self::getGameData();

        // Find room
        $roomData = $gameData['room'] ?? [];

        return $roomData;
    }

    // Get room status from storage
    public static function getRoomStatusFromStorage()
    {
        $gameData = self::getGameData();

        // Find inventory part
        $roomData = $gameData['room'] ?? [];

        return $roomData['status'];
    }

    // Set item to local storage
    public static function setItem($key, $value): bool
    {
        $game = self::getGameData();
        $game[$key] = $value;

        $room = $game['room'];
        $inventory = new Inventory($game['inventory']['items'] ?? []);

        return self::saveGameData($room, $inventory) !== false;
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
        $game = self::getGameData();
        unset($game['inventory']->getAllItems()[$key]); // Possible?

        $inventory = new Inventory($game['inventory']['items'] ?? []);

        return self::saveGameData(null, $inventory) !== false;
    }

    // Clear savegilr
    public static function clearSaveFile(): void
    {   
        $storageFile = __DIR__ . '/../Proj/data/save/storageHandler.json';
        
        file_put_contents($storageFile, '{}');
    }

    // Clear local storage
    public static function clearStorage(): bool
    {
        $room = [];
        $inventory = new Inventory([]);
        $objectStates = [];
        $database = null;

        return self::saveGameData($room, $inventory, $objectStates, $database) !== false;
    }

    // Clear cache
    public static function clearCache(): void {
        $cache = new FilesystemAdapter();
        $cache->clear();
    }

    // Remodel to save the inventory to state for use as database

    // Set object state
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

    // Get object state
    public static function getObjectState($roomId, $itemName) {
        $game = self::getGameData();

        // Set object states
        if (!isset($game['objectStates'])) {
            return null;
        }

        $key = "room_{$roomId}_item_{$itemName}";

        return $game['objectStates']['key'] ?? null;
    }

    // Check if item state is matching, need a bool
    public static function matchItemState($roomId, $itemName, $state) {
        return self::getObjectState($roomId, $itemName) === $state;
    }

    // Set item status variable
    public static function setItemStatus($roomId, $itemName, $status) {
        // Add a try
        $currentItem = self::getItem($roomId, $itemName);
        $currentItem->status = $status;

        return true;
    }

    // Get item status variable
    // Alter for internal database
    public static function getItemStatus($roomId, $itemName) {
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

    public static function findItemFromStorage($roomId, $itemName) {
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
