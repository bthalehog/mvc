<?php

namespace App\Proj;

use PHPUnit\Framework\TestCase;
use App\Proj\RoomHandler;
use App\Proj\StorageHandler;

/**
 * Test cases for class RoomHandler.
 */
class InventoryTest extends TestCase
{   
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function setUp(): void
    {
        // Instantiate and assertInstance
        $this->inventory = new Inventory();

        $this->assertInstanceOf("\App\Proj\Inventory", $this->inventory);
    } 

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testConstruct(): void
    {
        // Instantiate and assertInstance
        $inventory = new Inventory();

        $this->assertInstanceOf("\App\Proj\Inventory", $inventory);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testConstructorEmptyArray(): void
    {
        // Instantiate and assertInstance
        $inventory = new Inventory();

        $this->assertEmpty($inventory->getAllItems());
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testConstructorWithItemsArray(): void
    {   
        // Items array
        $itemsArray = [
            ['item' => 'key', 'description' => 'A small key'],
            ['item' => 'wire', 'description' => 'A piece of wire']
        ];

        // Instantiate and assertInstance
        $inventory = new Inventory($itemsArray);

        $this->assertCount(2, $inventory->getAllItems());
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testAddItem(): void
    {   
        // Item
        $itemToAdd = ['item' => 'key', 'description' => 'A small key'];

        // Add
        $result = $this->inventory->addItem($itemToAdd);

        // Test
        $this->assertEquals("Item added", $result);
        $this->assertCount(1, $this->inventory->getAllItems());
        $this->assertEquals($itemToAdd, $this->inventory->getAllItems()[0]);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testRemoveItem(): void
    {   
        // Item
        $itemToRemove = ['item' => 'key', 'description' => 'A small key'];

        // Add
        $this->inventory->addItem($itemToRemove);

        // Items count
        $itemsCount = count($this->inventory->getAllItems());

        // Remove
        $result = $this->inventory->removeItem('key');
        $inventoryItems = $this->inventory->getAllItems();
        
        // Test
        $this->assertEquals(($itemsCount - 1), count($inventoryItems));
        $this->assertTrue($result);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testRemoveItemNotInInventory(): void
    {   
        // Add
        $result = $this->inventory->removeItem('sack');

        // Test
        $this->assertFalse($result);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testSelectItem(): void
    {   
        // Add item to select
        $itemToAdd = ['item' => 'key', 'description' => 'A small key'];
        $this->inventory->addItem($itemToAdd);

        // Select
        $result = $this->inventory->select('key');

        // Test
        $this->assertEquals('key', $result['item']);
        $this->assertTrue($result['isSelected']);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testSelectItemNotInInventory(): void
    {   
        // Select
        $result = $this->inventory->select('sack');

        // Test
        $this->assertNull($result);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testDeselectItem(): void
    {   
        // Add item to select and deselect
        $itemToAdd = ['item' => 'key', 'description' => 'A small key'];
        $this->inventory->addItem($itemToAdd);

        // Select
        $result = $this->inventory->select('key');
        $this->assertNotNull($result);
        $this->assertTrue($result['isSelected']);

        // Test / Deselect
        $result = $this->inventory->select('key');
        $this->assertNull($result);

        // Get selected
        $selected = $this->inventory->getSelectedItem();

        // Test
        $fullInventory = $this->inventory->getAllItems();
        $this->assertCount(1, $fullInventory);
        $this->assertFalse($fullinventory[0]['isSelected'] ?? false); // Has to be same as return
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testGetSelected(): void
    {   
        // Add item to select and get
        $itemToAdd = ['item' => 'key', 'description' => 'A rusty key'];
        $this->inventory->addItem($itemToAdd);

        // Select
        $this->inventory->select('key');

        // Get selected
        $selected = $this->inventory->getSelectedItem();
        
        // Test
        $this->assertNotNull($selected);
        $this->assertEquals('key', $selected['item']);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testGetSelectedWithNone(): void
    {   
        // Get selected
        $selected = $this->inventory->getSelectedItem();
        
        // Test
        $this->assertNull($selected);
    }
}
