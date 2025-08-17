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
        $this->room = $this->getRoom($room);
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
        $roomsDatabase = __DIR__ . '/data/game_rooms.json';

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
        $currentRoomData = self::getRoomData($currentRoomId);

        foreach($currentRoomData['directions'] as $loopedDirection => $roomName)
        {
            if ($loopedDirection === $direction)
            {
                if ($roomName === "Closed")
                {
                    return ['success' => false, 'message' => "The door is closed."];
                }

                elseif ($roomName === "Locked")
                {
                    return ['success' => false, 'message' => "The door is locked..."];
                }
                else 
                {
                    return ['success' => true, 'redirect' => $roomName];
                }
            }
        }

        return ['success' => false, 'message' => "No way!"];
    }
}
