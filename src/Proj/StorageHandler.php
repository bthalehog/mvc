<?php

namespace App\Proj;

// For cache handling
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Handles game state persistency
 */
class StorageHandler
{
    protected static string $saveFile = __DIR__ . '/data/save/storageHandler.json';

    public function __construct(string $file = 'storageHandler.json')
    {
        $saveDir = __DIR__ . '/data/save/';

        if (!is_dir($saveDir)) {
            mkdir($saveDir, 0775, true); // 0755 for local, 0775 for webserver access (0777 for all full)
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

        $result = file_put_contents(self::$saveFile, json_encode($gameData, JSON_PRETTY_PRINT));
        // chmod(self::saveFile, 0664);
        return $result;
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
     * Updated to relative path for testing-purposes
     * @return void
     */
    public static function clearSaveFile(): void
    {        
        file_put_contents(self::$saveFile, '{}');
        // chmod(self::saveFile, 0664);
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
