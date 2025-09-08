<?php

namespace App\Proj;

use PHPUnit\Framework\TestCase;
use App\Proj\Inventory;
use App\Proj\RoomHandler;

/**
 * Test cases for class StorageHandler.
 */
class StorageHandlerTest extends TestCase
{   
    private string $testSavefile;
    private StorageHandler $testStorageHandler;

    /**
     * Setup for testing
     */
    public function setUp(): void
    {
        // Create testpath
        $this->testSavefile = __DIR__ . '/../../var/test_storageHandler.json';

        // get testDIr
        $testDir = dirname($this->testSavefile);

        if (!is_dir($testDir)) {
            mkdir($testDir, 0775, true);
        }

        // Create testStoragehandler with test-database
        $this->testStorageHandler = new StorageHandler('test_storageHandler.json');

        StorageHandler::clearStorage();
    }

    /**
     * Tear down the setup from setUp
     */
    public function tearDown(): void
    {
        // Check for test file
        if (file_exists($this->testSavefile)) {
            unlink($this->testSavefile);
        }
    }

    /**
     * Test constructing StorageHandler-object
     */
    public function testConstructObject()
    {   
        // Create object

        $storageHandler = new StorageHandler();

        $this->assertInstanceOf('App\Proj\StorageHandler', $storageHandler);
    }

     /**
     * Test saveGameData with database-arg
     */
    public function testSaveGameDataDatabase(): void 
    {   
        // Mock database
        $database = [
            'rooms' => [
                ['id' => 'room_one', 'name' => "Janitor's closet"]
            ]
        ];

        // Save game data with database arg
        StorageHandler::saveGameData(null, null, null, $database);

        // Get database
        $savedDatabase = StorageHandler::getDatabaseFromStorage();

        // Test
        $this->assertEquals($database, $savedDatabase);
    }

    /**
     * Test saving and getting database from storage
     */
    public function testSaveAndGetDatabase(): void 
    {   
        // Mock database
        $database = [
            'rooms' => [
                ['id' => 'room_one', 'name' => "Janitor's closet"]
            ]
        ];

        // Save game data with database arg
        StorageHandler::saveGameData(null, null, null, $database);

        // Get database
        $fetchedDatabase = StorageHandler::getDatabaseFromStorage();

        // Test
        $this->assertEquals($database, $fetchedDatabase);
    }

    /**
     * Test saveGameData with room-arg
     */
    public function testSaveGameDataRoom(): void 
    {   
        // Build and save game data with room arg
        $room = ['id' => 'room_one', 'name' => "Janitor's closet"];
        $result = StorageHandler::saveGameData($room); // WHy not working without null, null is default?

        // Test
        $this->assertTrue($result > 0);

        // Get gameData
        $gameData = StorageHandler::getGameData();

        // Test
        $this->assertEquals('room_one', $gameData['room']['id']);
        $this->assertEquals("Janitor's closet", $gameData['room']['name']);
    }

    /**
     * Test saving and getting room from gameData
     */
    public function testSaveAndGetRoom(): void 
    {   
        // Build and save room
        $room = ['id' => 'room_one', 'name' => "Janitor's closet"];
        $result = StorageHandler::saveGameData($room, null); // WHy not working without null, null is default?
        
        // Get game data
        $gameData = StorageHandler::getGameData();

        // Test
        $this->assertEquals('room_one', $gameData['room']['id']);
        $this->assertEquals("Janitor's closet", $gameData['room']['name']);
    }

    /**
     * Test getRoomData
     */
    public function testGetRoomData(): void 
    {   
        // Build and save gameData with room arg
        $room = ['id' => 'room_one', 'name' => "Janitor's closet"];
        StorageHandler::saveGameData($room, null);

        // Get room data
        $result = StorageHandler::getRoomData();
        
        // Test
        $this->assertEquals($room, $result);
    }

    /**
     * Test saveGameData with inventory-arg
     */
    public function testSaveGameDataInventory(): void 
    {   
        // Build inventory
        $inventory = new Inventory();
        $inventory->addItem(['item' => 'key', 'description' => 'A small key']);

        // Save
        $result = StorageHandler::saveGameData(null, $inventory);

        // Test byte size change, what else??
        $this->assertTrue($result > 0);
    }

    /**
     * Test saving and getting inventory
     */
    public function testSaveAndGetInventory(): void 
    {   
        // Build and save inventory
        $inventory = new Inventory();
        $inventory->addItem(['item' => 'key', 'description' => 'A small key']);
        StorageHandler::saveGameData(null, $inventory);

        // Get inventory
        $fetchedInventory = StorageHandler::getInventoryFromStorage();

        // Test
        $this->assertInstanceOf(Inventory::class, $fetchedInventory);
        $this->assertCount(1, $fetchedInventory->getAllItems());
        $this->assertEquals('key', $fetchedInventory->getAllItems()[0]['item']);
    }  

    /**
     * Test getRoom from storage
     */
    public function testGetRoomFromStorage(): void 
    {   
        // Create mock database
        $database = [
            'rooms' => [
                ['id' => 'room_one', 'name' => "Janitor's closet"]
            ]
        ];

        // Save state
        StorageHandler::saveGameData(null, null, null, $database);

        // Get room
        $room = StorageHandler::getRoomFromStorage('room_one');

        // Test
        $this->assertIsArray($room);
        $this->assertEquals("Janitor's closet", $room['name']);
    }

    /**
     * Test getItemStatus
     */
    public function testGetItemStatus(): void 
    {   
        // Create mock database
        $database = [
            'rooms' => [
                ['id' => 'room_one',
                 'name' => "Janitor's closet",
                 'items' => [
                    ['item' => 'door', 'status' => 1]
                 ]
                ]
            ]
        ];

        // Save state
        StorageHandler::saveGameData(null, null, null, $database);

        // Get item status
        $itemStatus = StorageHandler::getItemStatus('room_one', 'door');

        // Test
        $this->assertEquals(1, $itemStatus);
    }

    /**
     * Test findItem from storage
     */
    public function testFindItemFromStorage(): void 
    {
        // Create mock database
        $database = [
            'rooms' => [
                ['id' => 'room_one',
                 'name' => "Janitor's closet",
                 'items' => [
                    ['item' => 'door', 'status' => 1]
                 ]
                ]
            ]
        ];

        // Save state
        StorageHandler::saveGameData(null, null, null, $database);

        // Find item
        $itemFound = StorageHandler::findItemFromStorage('room_one', 'door');

        // Test
        $this->assertEquals('door', $itemFound['item']);
        $this->assertEquals(1, $itemFound['status']);
        $this->assertIsArray($itemFound);
    }

    /**
     * Test isSelected
     */
    public function testIsSelected(): void 
    {   
        // Build inventory, add and select item
        $inventory = new Inventory();
        $inventory->addItem(['item' => 'key', 'description' => 'A small key']);
        $inventory->select('key');

        // Save state
        StorageHandler::saveGameData(null, $inventory);

        // Set item for check
        $item = ['item' => 'key', 'description' => 'A small key'];

        // Test
        $result = StorageHandler::isSelected($item);

        $this->assertTrue($result);
    }

    /**
     * Test clearStorage
     */
    public function testClearStorage(): void 
    {
        // Set vars and saveGameData
        $room = ['id' => 'room_one', 'name' => "Janitor's closet"];
        $inventory = new Inventory();

        StorageHandler::saveGameData($room, $inventory);

        // Clear storage
        $result = StorageHandler::clearStorage();
        $this->assertTrue($result);

        // Get gamedata
        $gameData = StorageHandler::getGameData();

        // Test
        $this->assertEmpty($gameData['room']);
        $this->assertEmpty($gameData['inventory']['items']);
    }

    /**
     * Test clearSavefile
     */
    public function testClearSavefile(): void 
    {
        $room = ['id' => 'room_one', 'name' => "Janitor's closet"];
        StorageHandler::saveGameData($room);
        
        // Clear
        StorageHandler::clearSaveFile();

        // Get game data after clear
        $gameDataCleared = StorageHandler::getGameData();

        // Test
        $this->assertEmpty($gameDataCleared);
        $this->assertArrayNotHasKey('room', $gameDataCleared);
    } 
}
