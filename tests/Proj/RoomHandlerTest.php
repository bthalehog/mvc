<?php

namespace App\Proj;

use PHPUnit\Framework\TestCase;
use App\Proj\StorageHandler;
use App\Proj\RoomHandler;

/**
 * Test cases for class RoomHandler.
 */
class RoomHandlerTest extends TestCase
{   
    private $storageHandler;
    private $database;
    
    /**
     * Setup for testing
     */
    public function setUp(): void {
        $mockDatabase = [
            "rooms" => [
                [
                    "id" => "room_one",
                    "name" => "Janitor's closet",
                    "info" => "You get a hold of your surroundings, you seem to be in the janitor's closet, you rattle the door handle only to find it is locked!",
                    "items" => [
                        [ "item" => "key", "look" => "A coat", "investigate" => "There is a key in one of the pockets", "interact" => "You pick up the key", "use_with" => "forklift", "accept" => null, "take" => "yes", "graphics" => "🔑"],
                        [ "item" => "wire", "look" => "There is something in the bin.", "investigate" => "Aah metal, the fabric of tools!", "interact" => "You found a paper-clip!", "use_with" => "door", "accept" => null, "take"=> "yes", "graphics" => "📎"],
                        [ "item" => "box", "look" => "There is a beverage box on one of the shelves.", "investigate" => "It has potential..", "interact" => "Congratulations, proud owner of empty beverage box.", "use_with" => "fountain", "accept" => null, "take" => "yes", "graphics" => "🧃" ],
                        [ "item" => "door_one", "look" => "The way out of here.", "investigate" => "It seem locked from the outside.", "interact" => "Way to MacGyver!", "use_with" => null, "accept" => "wire", "handshake" => "Way to go MacGyver!", "take" => "no", "graphics" => null, "status" => 0]
                    ],
                    "directions" => [
                        ["north" => "room_two"]
                    ],
                    "gates" => [
                        ["north" => "door_one"]
                    ],
                    "graphics" => [
                        [ "background" => "room1background.png" ]
                    ],
                    "clue" => "Well, there is a door..."
                ],
                [
                    "id" => "room_two",
                    "name" => "Hallway",
                    "info" => "You find yourself standing at a crossroads, what to do!?",
                    "items" => [
                        [ "item" => "note", "look" => "A piece of paper", "investigate" => "The number 4526 is written on the back", "interact" => "Seems I pick things up habitually now", "use_with" => null, "accept" => null, "take" => "yes", "graphics" => "📃" ],
                        [ "item" => "haphazardous_event", "look" => "This door has a sign on it", "investigate" => "It says: 'Security'", "interact" => "GAME OVER - Don't you read signs?!", "use_with" => null, "accept" => null, "take" => "no", "graphics" => "deathtrap.png" ]
                    ],
                    "directions" => [
                        "north" => "deathtrap",
                        "east" => "room_three",
                        "south" => "room_one"
                    ],
                    "gates" => [
                    ],
                    "graphics" => [
                        [ "background" => "room2background.png" ]
                    ],
                    "clue" => "Hunter gatherer you are."
                ]
            ]
        ];

        // StorageHandler::saveGameData(null, null, null, $mockData);
        $this->storageHandler = new StorageHandler();
        $this->database = StorageHandler::getDatabaseFromStorage();
    }

    /**
     * Test get room data
     */
    public function testGetRoomData()
    {   
        // Get room
        $room = RoomHandler::getRoomData('room_one');

        $this->assertIsArray($room);
        $this->assertEquals('room_one', $room['id']);
    }

    /**
     * Test move when gate is blocked (0)
     */
    public function testMoveBlocked()
    {       
        // Set current room
        $currentRoomId = 'room_one';

        // Move (from current room )
        $result = RoomHandler::move("north", $currentRoomId);

        // Test
        $this->assertFalse($result['success']);
        $this->assertEquals("No way!", $result['message']);
    }

    /**
     * Test move when gate is open (1)
     */
    public function testMove()
    {       
        // Get room for testing
        $currentRoomId = 'room_two';

        // Move (start in room )
        $result = RoomHandler::move("east", $currentRoomId);

        // Test
        $this->assertTrue($result['success']);
    }

    /**
     * Test move from none-existans room.
     */
    public function testMoveInvalidRoom()
    {       
        // Move (start in room )
        $result = RoomHandler::move("east", "invalid_room");

        // Test
        $this->assertFalse($result['success']);
        $this->assertEquals("No such room.", $result['message']);
    }
}
