<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

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
        $this->inventory = StorageHandler::getInventoryFromStorage();
    }

    #[Route("/proj", name: "proj")]
    public function index(): Response
    {
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
        $this->storageHandler->saveGameData($this->room, $this->inventory);

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

        // print_r($this->inventory->getAllItems());

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
        $roomTwo = RoomHandler::getRoomData("room_two");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        $data = [
            'room' => $roomTwo,
            'inventory' => $this->inventory
        ];

        // Save data (needs an update approach), sort and update in saveGameData-function
        StorageHandler::saveGameData($roomTwo, $this->inventory);

        return $this->render('proj/room_two.html.twig', $data);
    }

    #[Route('/project/room_three', name: 'room_three')]
    public function roomThree(): Response
    {
        $roomThree = RoomHandler::getRoomData("room_three");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        $data = [
            'room' => $roomThree,
            'inventory' => $this->inventory
        ];

        // Save data (needs an update approach), sort and update in saveGameData-function
        StorageHandler::saveGameData($roomThree, $this->inventory);

        return $this->render('proj/room_three.html.twig', $data);
    }

    #[Route('/project/room_four', name: 'room_four')]
    public function roomFour(): Response
    {
        $roomFour = RoomHandler::getRoomData("room_four");

        // Get fresh inventory
        $this->inventory = StorageHandler::getInventoryFromStorage();

        $data = [
            'room' => $roomFour,
            'inventory' => $this->inventory
        ];

        // Save data (needs an update approach), sort and update in saveGameData-function
        StorageHandler::saveGameData($roomFour, $this->inventory);

        return $this->render('proj/room_four.html.twig', $data);
    }

    #[Route('/project/deathtrap', name: 'deathtrap')]
    public function deathTrap(): Response
    {
        $deathTrap = [
            'name' => 'Game Over',
            'info' => 'Read the signs man..',
            'graphics' => [
                ['background' => 'deathtrap.png']
            ]
        ];

        $this->inventory = StorageHandler::getInventoryFromStorage();

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
        // echo "ROUTE WORKING<br>";

        // Get room id for routing
        $currentRoom = $this->storageHandler->getRoomFromStorage();
        $this->room = $currentRoom;

        // echo "Got room from storeage<br>";

        if ($request->isMethod('GET')) 
        {
            // echo "Its a GET!<br>";

            // Get data (query)
            $itemName = $request->query->get('itemName');
            $roomNumber = $request->query->get('roomNumber');
            
            // echo $itemName . "<br>";
            // echo $roomNumber . "<br>";

            // Find item in database
            if ($itemName && $roomNumber) {
                // echo "Both exists!<br>";
                
                // Get all room data
                $roomsData = RoomHandler::getAllRooms();
                // echo "Got rooms!<br>";

                // echo $roomNumber ."<br>";
                // print_r($roomsData);
                // echo "<br>";

                // Match room and item
                if ($roomsData['rooms']) {
                    // echo "Found matching room!<br>";

                    // Find room by id
                    $locatedRoom = null;

                    foreach ($roomsData['rooms'] as $room) {
                        if ($room['id'] === $roomNumber) {
                            $locatedRoom = $room;
                            break;
                        }
                    }

                    if ($room && isset($room['items'])) {
                        // echo "Room has items!<br>";

                        foreach ($room['items'] as $item) {
                            if ($item['item'] === $itemName) {
                                // echo "Match found!<br>";

                                // Write to inventory
                                $this->inventory->addItem($item);
                                // echo "Added to inv!<br>";

                                // Save
                                StorageHandler::saveGameData($this->room, $this->inventory); // Was still using removed  $this->storageHAndler
                                // echo "Save!<br>";
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
}
