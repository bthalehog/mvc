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
    private string $originalSavefile;
    private string $testSavefile;

    /**
     * Construct object with minimal arguments and verify that the object has the expected
     * properties.
     */
    public function setUp()
    {   
        $this->originalSavefile = StorageHandler::$saveFile;

        // Create file path for test save
        $this->testSavefile = __DIR__ . '/../../var/test_storageHandler.json';
        StorageHandler::$saveFile = $this->testSaveFile;
    }
}
