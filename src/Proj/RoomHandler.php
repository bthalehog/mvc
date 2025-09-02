<?php

namespace App\Proj;

use App\Proj\data\database\game_rooms;

/**
 * Handles room loading
 */
class RoomHandler
{
    public function __construct($room)
    {
        $this->room = $this->getRoomData($room);
    }

    // Get room data
    public static function getRoomData($roomId): ?array
    {
        $roomsDatabase = __DIR__ . '/data/database/game_rooms.json';

        if (!file_exists($roomsDatabase)) {
            return null;
        }

        $decodedDatabase = json_decode(file_get_contents($roomsDatabase), true);

        if (!$decodedDatabase) {
            return null;
        }

        // Find and return demanded (arg) room.
        foreach ($decodedDatabase['rooms'] as $room) {
            if ($room['id'] === $roomId) {
                return $room;
            }
        }
    }
    

    // Get all rooms
    public static function getAllRooms(): ?array
    {
        $roomsDatabase = __DIR__ . '/data/database/game_rooms.json';

        if (!file_exists($roomsDatabase)) {
            return "No database found";
        }

        $decodedDatabase = json_decode(file_get_contents($roomsDatabase), true);

        if (!$decodedDatabase) {
            return "No decoded database found";
        }

        return $decodedDatabase;
    }

    // Handle user move input
    public static function move($direction, $currentRoomId): array {
        $database = StorageHandler::getDatabaseFromStorage();
        $currentRoomData = null;

        // Find room and verify direction
        foreach ($database['rooms'] as $room) {
            if ($room['id'] === $currentRoomId) {
                // Verify direction

                if (!isset($room['directions'][$direction])) {
                    return ['success' => false, 'message' => "No way!"];
                }

                $roomName = $room['directions'][$direction];

                // Check gate
                if (isset($room['gates'][$direction])) {
                    $gateItemName = $room['gates'][$direction];

                    foreach($room['items'] as $item) {
                        if ($item['item'] === $gateItemName) {
                            if ($item['status'] === 0) {
                                return ['success' => false, 'message' => "The door is locked."];
                            }
                            break;
                        }
                    }
                }

                return ['success' => true, 'redirect' => $roomName];
            }
        }
        return ['success' => false, 'message' => "No such room."];
    }
}
