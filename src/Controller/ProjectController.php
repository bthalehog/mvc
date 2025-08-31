<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Proj\StorageHandler;
use App\Proj\RoomHandler;
use App\Proj\data\database\game_rooms;
use App\Proj\Inventory;

final class ProjectController extends AbstractController
{   
    private Inventory $inventory;
    private StorageHandler $storageHandler;
    private RoomHandler $roomHandler;

    // Added for building inventory and storage
    public function __construct() {
        $this->storageHandler = new StorageHandler();
        $this->room = Roomhandler::getRoomData("proj") ?? [];
        // This should fix the array issue
        $this->inventory = StorageHandler::getInventoryFromStorage() ?: new Inventory();
    }

    #[Route("/proj", name: "proj")]
    public function index(): Response
    {
        StorageHandler::clearStorage();

        // Set parameters
        $info = "You wake up in a strange room with a very, I mean VERY, strong urge to immediately escape.";
        $rules = "Use the arrow buttons to navigate, click to interact with objects";
        
        // Added inventory to data
        $data = [
            'id' => "proj",
            'info' => $info,
            'rules' => $rules,
            'inventory' => $this->inventory // Added
        ];

        // Set room var
        $this->room = $data;

        // Save
        StorageHandler::saveGameData($this->room, $this->inventory);

        return $this->render('proj/start_adventure.html.twig', $data);
    }

    #[Route('/project/room_one', name: 'room_one')]
    public function roomOne(): Response
    {
        $roomOne = RoomHandler::getRoomData("room_one");

        if (!$roomOne) {
            throw $this->createNotFoundException('Room not found');
        }

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Save data (needs an update approach), sort and update in saveGameData-function
        StorageHandler::saveGameData($roomOne, $this->inventory);

        // Set data for rendering
        $data = [
            'room' => $roomOne,
            'inventory' => $this->inventory
        ];

        return $this->render('proj/room_one.html.twig', $data);
    }

    #[Route('/project/room_two', name: 'room_two')]
    public function roomTwo(): Response
    {
        // Get room data
        $roomTwo = RoomHandler::getRoomData("room_two");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Save
        StorageHandler::saveGameData($roomTwo, $this->inventory);

        // Structure for rendering
        $data = [
            'room' => $roomTwo,
            'inventory' => $this->inventory
        ];

        return $this->render('proj/room_two.html.twig', $data);
    }

    #[Route('/project/room_three', name: 'room_three')]
    public function roomThree(): Response
    {
        // Get room data
        $roomThree = RoomHandler::getRoomData("room_three");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Save state ?? redundant?
        StorageHandler::saveGameData($roomThree, $this->inventory);

        // Structure for rendering
        $data = [
            'room' => $roomThree,
            'inventory' => $this->inventory
        ];

        return $this->render('proj/room_three.html.twig', $data);
    }

    #[Route('/project/room_four', name: 'room_four')]
    public function roomFour(): Response
    {
        // Get room data
        $roomFour = RoomHandler::getRoomData("room_four");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Save state
        StorageHandler::saveGameData($roomFour, $this->inventory);

        // Structure for rendering
        $data = [
            'room' => $roomFour,
            'inventory' => $this->inventory
        ];

        return $this->render('proj/room_four.html.twig', $data);
    }

    #[Route('/project/deathtrap', name: 'deathtrap')]
    public function deathTrap(): Response
    {   
        // Build room data
        $deathTrap = [
            'name' => 'Game Over',
            'info' => 'Read the signs man..',
            'graphics' => [
                ['background' => 'deathtrap.png']
            ]
        ];

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Save state
        StorageHandler::saveGameData($roomFour, $this->inventory);

        // Structure for rendering
        $data = [
            'room' => $deathTrap,
            'inventory' => $this->inventory
        ];

        return $this->render('proj/room_four.html.twig', $data);
    }

    #[Route('/project/move', name: 'move')]
    public function mover(Request $request): Response
    {
        // Get direction from input
        $direction = $request->request->get('direction');

        // Get currentRoomId
        $currentRoomId = $request->request->get('currentRoomId');
        
        // Move in found direction
        $result = RoomHandler::move($direction, $currentRoomId);

        if ($result['success']) {
            // Redirect on success
            return $this->redirectToRoute($result['redirect']);
        }
        else {
            return $this->redirectToRoute($currentRoomId);
        }
    }

    #[Route('/project/inventory', name: 'inventory')]
    public function inventory(Request $request): Response
    {   
        if ($request->isMethod('POST')) 
        {
             // Get all data POSTed
            $dataPOSTed = $request->request->all();

            // Find which item selected
            foreach ($dataPOSTed as $itemName => $itemValue) {
                if (!empty($itemValue)) {
                    $this->inventory->select($itemName);
                    break;
                }
            }

            // Save state
            StorageHandler::saveGameData(null, $this->inventory);

            // Return to previous route
            $ref = $request->headers->get('referer');

            if ($ref) {
                return $this->redirect($ref);
            }

            return $this->redirectToRoute('proj');
        }

        // Refresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();
        
        // print_r($this->inventory->getAllItems());

        return $this->render('proj/inventory.html.twig', [
            'inventory' => $this->inventory
        ]);
    }

    #[Route('/project/inventory/add', name: 'inventory_add')]
    public function inventoryAdd(Request $request): Response
    {   
        // Get room id for routing
        $currentRoom = StorageHandler::getRoomFromStorage();
        
        if ($request->isMethod('GET')) 
        {
            // Get data (query)
            $itemName = $request->query->get('itemName');
            $roomNumber = $request->query->get('roomNumber');

            // Find item in database
            if ($itemName && $roomNumber) {                
                // Get all room data
                $roomsData = RoomHandler::getAllRooms();

                // Match room and item
                if ($roomsData['rooms']) {
                    // Find room by id
                    $locatedRoom = null;

                    foreach ($roomsData['rooms'] as $room) {
                        if ($room['id'] === $roomNumber) {
                            $locatedRoom = $room;
                            break;
                        }
                    }

                    if ($locatedRoom && isset($locatedRoom['items'])) {
                        // echo "Room has items!<br>";

                        foreach ($locatedRoom['items'] as $item) {
                            if ($item['item'] === $itemName) {
                                // Write to inventory
                                $this->inventory->addItem($item);

                                // Save
                                StorageHandler::saveGameData($currentRoom, $this->inventory); // Was still using removed  $this->storageHAndler
                                
                                // echo "Save!<br>";
                                // die();
                            }
                        }
                    }
                }
            }

            // Redirect
            return $this->redirectToRoute($roomNumber, [
                'infoDisplay' => $itemName ? "$itemName added to inventory." : null,
                'success' => true
            ]);
        }

        // If no request
        return $this->redirectToRoute($roomNumber);
    }

    #[Route('/project/api/objectInteraction/{roomId}/{itemName}', name: 'object_interaction', methods: ['GET'])]
    public function objectInteraction($roomId, $itemName, Request $request): JsonResponse
    {                 
        $hasItem = false;
        $matchingItem = null;

        // Check object status
        if (StorageHandler::getItemStatus($roomId, $itemName) === 1) {
            return $this->json([
                'success' => true,
                'status' => 1
            ]);
        }

        // Get item data
        $interactionItem = StorageHandler::findItemFromStorage($roomId, $itemName); // New method
        
        // Check existance
        if (!$interactionItem) {
            return $this->json([
                'success' => false,
                'message' => 'No item found'
            ]);
        }

        // Get inventory
        $inventory = StorageHandler::getInventoryFromStorage();
        $allItems = $inventory->getAllItems();

        // Set hasItem on handshake
        foreach ($allItems as $ownedItem) {
            if ($interactionItem['accept'] === $ownedItem['item']) {
                $hasItem = true;
                $matchingItem = $ownedItem;
                break;
            }
        }

        if ($hasItem && StorageHandler::isSelected($matchingItem)) {
            // Get database
            $database = StorageHandler::getDatabaseFromStorage();
            $gameData = StorageHandler::getGameData();

            foreach($database['rooms'] as &$room) {
                if ($room['id'] === $roomId && isset($room['items'])) {
                    foreach($room['items'] as &$item) {
                        if ($item['item'] === $itemName) {
                            $item['status'] = 1;
                            break 2;
                        }
                    }
                }
            }

            // Deselect and remove from inventory after use
            $inventory = StorageHandler::getInventoryFromStorage();
            $inventory->removeItem($matchingItem['item']);

            // Save state
            StorageHandler::saveGameData(null, $inventory, null, $database);

            return $this->json([
                'success' => true,
                'infoDisplay' => $interactionItem['handshake'],
                'stateAltered' => true
            ]);
        }
        
        return $this->json([
            'success' => false,
            'message' => 'You need another item'
        ]);

        // Should I instead load the database to a var I save in the savefile so I can alter it and save it with new state?
    }
}
