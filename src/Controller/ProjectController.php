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
    private array $room;

    // Added for building inventory and storage
    public function __construct() {
        $this->storageHandler = new StorageHandler();
        $this->room = RoomHandler::getRoomData("proj") ?? [];
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
            'inventory' => $this->inventory, // Added
            'clearClickers' => false
        ];

        // Set room var
        $this->room = $data;

        // Save
        StorageHandler::saveGameData($this->room, $this->inventory);

        return $this->render('proj/start_adventure.html.twig', $data);
    }

    #[Route("/proj/about", name: "proj_about")]
    public function about(): Response
    {
        // Set headline
        $headline = "About this adventure game";

        // Set parameters
        $info = "
            This is an adventure game made as examination project in the course MVC given at BTH 2025.
            The game consists of a number of rooms, items and doors that, if combined correctly, will lead you to the exit.<br>
            
            In the rooms are doors that sometimes are locked and can be opened.<br>
            To have an item interact with another, select the item in your inventory and then click the item you want to interact with.<br>
            Navigation between rooms is done using the navigation-arrows in the panel.<br>
            
            In this scenario you find yourself waking up in a closet with an urge to get out. You have no memory of how you ended up there just a burning sensation that you should get out.
        ";
        
        $cheat = "
            <ul class='about'>
                <li><strong>Room 1 - Janitor's closet</strong></li>
                    <ul>
                        <li>items: key (in coat), cup (in shelf, no use), wire (in bin)</li>
                        <li>gates: door (accepts wire)</li>
                    </ul>

                <li><strong>Room 2 - Hallway</strong></li>
                    <ul>
                        <li>items: note (eastern wall crevice, no use)</li>
                        <li>gates: western door (leads nowhere)
                        northern door (three clicks = GAME OVER)
                        eastern door (lead to warehouse, unlocked)</li>
                    </ul>
                
                <li><strong>Room 3 - Warehouse</strong></li>
                    <ul>
                        <li>items: forklift (takes key), radio (three clicks to start music)</li>
                        <li>gates: emergency exit (locked, cannot be opened)
                        x (win game by clicking the X three times after starting the forklift and turning on some music)</li>
                    </ul>

                <li><strong>Room 4 - Guards' room</strong></li>
                    <ul>
                        <li>This is an instant GAME OVER triggered by clicking three times on the nortern door in Hallway.</li>
                    </ul>
                <br>
        ";

        $install = "<ul class='about'>
                <li>Install the following:</li>
                    <ul>
                        <li>PHP 8.1 or higher</li>
                        <li>Composer</li>
                        <li>Git</li>
                        <li>Node.js</li>
                        <li>Encore</li>
                    </ul>

                <li>Clone the repository</li>
                    <ul>
                        <li>git clone 'repository-directory'</li>
                        <li>cd 'project-directory'</li>
                    </ul>
                
                <li>Install dependencies</li>
                    <ul>
                        <li>composer install</li>
                        <li>npm install</li>
                    </ul>
                
                <li>Run build and launch</li>
                    <ul>
                        <li>npm run build</li>
                        <li>symfony server:start</li>
                        <li>Open in <a href='http://127.0.0.1:8000'>browser</a></li>
                    </ul>
        ";

        $data = [
            'headline' => $headline,
            'info' => $info,
            'cheat' => $cheat,
            'install' => $install,
            'clearClickers' => false
        ];

        return $this->render('proj/about.html.twig', $data);
    }

    #[Route('/proj/room_one', name: 'room_one')]
    public function roomOne(): Response
    {
        // $roomOne = RoomHandler::getRoomData("room_one");
        $roomOne = StorageHandler::getRoomFromStorage("room_one");

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
            'inventory' => $this->inventory,
            'clearClickers' => false
        ];

        return $this->render('proj/room_one.html.twig', $data);
    }

    #[Route('/proj/room_two', name: 'room_two')]
    public function roomTwo(): Response
    {
        // Get room data
        // $roomTwo = RoomHandler::getRoomData("room_two");
        $roomTwo = StorageHandler::getRoomFromStorage("room_two");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Save
        StorageHandler::saveGameData($roomTwo, $this->inventory);

        // Structure for rendering
        $data = [
            'room' => $roomTwo,
            'inventory' => $this->inventory,
            'clearClickers' => false
        ];

        return $this->render('proj/room_two.html.twig', $data);
    }

    #[Route('/proj/room_three', name: 'room_three')]
    public function roomThree(): Response
    {
        // Get room data
        // $roomThree = RoomHandler::getRoomData("room_three");
        $roomThree = StorageHandler::getRoomFromStorage("room_three");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Save state ?? redundant?
        StorageHandler::saveGameData($roomThree, $this->inventory);

        // Structure for rendering
        $data = [
            'room' => $roomThree,
            'inventory' => $this->inventory,
            'clearClickers' => false
        ];

        return $this->render('proj/room_three.html.twig', $data);
    }

    #[Route('/proj/deathtrap', name: 'deathtrap')]
    public function deathTrap(): Response
    {   
        // $deathTrap = RoomHandler::getRoomData("deathtrap");
        $deathTrap = StorageHandler::getRoomFromStorage("deathtrap");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        // Clear state and savefile
        StorageHandler::clearStorage();
        StorageHandler::clearSaveFile();
        StorageHandler::clearCache();

        // Structure for rendering
        $data = [
            'room' => $deathTrap,
            'inventory' => $this->inventory,
            'graphics' => [
                ['background' => 'deathtrap.png']
            ],
            'clearClickers' => true
        ];

        return $this->render('proj/deathtrap.html.twig', $data);
    }

    #[Route('/proj/final_move', name: 'final_move')]
    public function finalMove(): Response
    {
        // Get room data
        // $finalMove = RoomHandler::getRoomData("final_move");

        $finalMove = StorageHandler::getRoomFromStorage("final_move");

        // Save state
        StorageHandler::saveGameData($finalMove, $this->inventory);

        // Structure for rendering
        $data = [
            'room' => $finalMove,
            'inventory' => $this->inventory,
            'clearClickers' => true
        ];

        // Clear and Save state
        StorageHandler::clearStorage();
        StorageHandler::clearSaveFile();
        StorageHandler::clearCache();

        // StorageHandler::saveGameData($finalMove, $this->inventory);

        return $this->render('proj/final_move.html.twig', $data);
    }

    #[Route('/proj/move', name: 'move')]
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

    #[Route('/proj/inventory', name: 'inventory')]
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

    #[Route('/proj/inventory/add', name: 'inventory_add')]
    public function inventoryAdd(Request $request): Response
    {   
        // Get room id for routing
        $currentRoom = StorageHandler::getRoomData();
        
        if ($request->isMethod('GET'))
        {
            // Get data (query)
            $itemName = $request->query->get('itemName');
            $roomNumber = $request->query->get('roomNumber');

            // Check if take: "no" or jus list non-takeables
            // Can also if in array
            if ($itemName === "emergency_exit" || $itemName === "forklift" || $itemName === "x" || $itemName === "haphazardous_event") {
                if ($itemName === "haphazardous_event") {
                    return $this->redirectToRoute('deathtrap');
                }
                return $this->redirectToRoute('room_three');
            }

            // Find item in database
            if ($itemName && $roomNumber) {                
                // Get all room data
                $roomsData = StorageHandler::getDatabaseFromStorage();

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

    #[Route('/proj/api/objectInteraction/{roomId}/{itemName}', name: 'object_interaction', methods: ['GET'])]
    public function objectInteraction($roomId, $itemName, Request $request): JsonResponse
    {   
        // Handle status on radio
        if ($roomId === 'room_three' && $itemName === "radio") {
            // Update status
            $database = StorageHandler::getDatabaseFromStorage();

            foreach($database['rooms'] as &$room) {
                if($room['id'] === $roomId && isset($room['items'])) {
                    foreach($room['items'] as &$item) {
                        if ($item['item'] === "radio") {
                            $item['status'] = 1;
                            break 2;
                        }
                    }
                }
            }

            // Get fresh inventory
            $inventory = StorageHandler::getInventoryFromStorage();

            // Save state
            StorageHandler::saveGameData(null, $inventory, null, $database);

            return $this->json([
                'success' => true,
                'infoDisplay' => "Radio is playing, about to get this breakout party started!",
                'stateAltered' => true
            ]);
        }

        // Handle status on forklift
        if ($roomId === 'room_three' && $itemName === "forklift") {
            // Check if key selected
            $inventory = StorageHandler::getInventoryFromStorage();
            $allItems = $inventory->getAllItems();
            $isSelected = false;

            foreach ($allItems as $ownedItem) {
                if ($ownedItem['item'] === "key" && StorageHandler::isSelected($ownedItem)) {
                    $isSelected = true;
                    break;
                }
            }

            if ($isSelected) {
                // Update forklift status
                $database = StorageHandler::getDatabaseFromStorage();

                foreach($database['rooms'] as &$room) {
                    if($room['id'] === $roomId && isset($room['items'])) {
                        foreach($room['items'] as &$item) {
                            if ($item['item'] === "forklift") {
                                $item['status'] = 1;
                                break 2;
                            }
                        }
                    }
                }

                // Remove item after use
                $inventory->removeItem("key");

                // Save state
                StorageHandler::saveGameData(null, $inventory, null, $database);
                
                // Return json
                return $this->json([
                    'success' => true,
                    'infoDisplay' => "The forklift is roaring, you are the captain now!",
                    'stateAltered' => true
                ]);
            } else {
                // Return json
                return $this->json([
                    'success' => false,
                    'infoDisplay' => "The forklift requires a key to start."
                ]);
            }
        }
        
        // Check for finalMove
        // Catch if room four (win scene) given and the item clicked is {itemName}
        if ($roomId === 'room_three' && $itemName === "x") {
            // Get database from storage
            $database = StorageHandler::getDatabaseFromStorage();

            // Get roomData from database
            $roomData = null;

            foreach ($database['rooms'] as $room) {
                if ($room['id'] === $roomId) {
                    $roomData = $room;
                    break;
                }
            }

            if (!$roomData) {
                return $this->json([
                    'success' => false,
                    'message' => "Room error in finalMovecheck in objectInteraction route"
                ]);
            }

            // Get X item
            $xItem = null;
            
            foreach($roomData['items'] as $item) {
                if ($item ['item'] === 'x') {
                    $xItem = $item;
                    break;
                }
            }

            if (!$xItem) {
                return $this->json([
                    'success' => false,
                    'message' => "X not found"
                ]);
            }

            // Key items status check
            $radioStatus = 0;
            $forkliftStatus = 0;

            foreach($roomData['items'] as $item) {
                if ($item['item'] === "radio") {
                    $radioStatus = $item['status'] ?? 0;
                }
                if ($item['item'] === "forklift") {
                    $forkliftStatus = $item['status'] ?? 0;
                }
            }

            if ($radioStatus === 1 && $forkliftStatus === 1) {
                // Win!
                return $this->json([
                    'success' => true,
                    'finalMove' => true,
                    'redirectTo' => 'final_move'
                ]);
            } else {
                // Get X clickcount
                $currentClickCount = $xItem['clickCount'] ?? 0;
                $currentClickCount++; // Or handled in clickCount already? am I doubling here?

                $message = "";
                if ($currentClickCount === 1) {
                    $message = $xItem['look'];
                } elseif ($currentClickCount === 2) {
                    $message = $xItem['investigate'];
                } else {
                    $message = $xItem['interact'];
                }

                // Update clickCount
                foreach($database['rooms'] as &$room) {
                    if($room['id'] === $roomId && isset($room['items'])) {
                        foreach($room['items'] as &$item) {
                            if ($item['item'] === "x") {
                                $item['clickCount'] = $currentClickCount;
                                break 2;
                            }
                        }
                    }
                }

                $inventory = StorageHandler::getInventoryFromStorage();
                StorageHandler::saveGameData(null, $inventory, null, $database);

                return $this->json([
                    'success' => true,
                    'infoDisplay' => $message,
                    'message' => true
                ]);
            }
        }

        // Run normal objectInteraction        
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
        $interactionItem = StorageHandler::findItemFromStorage($roomId, $itemName);
        
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
    }
}