<?php

namespace App\Proj;

use App\Proj\StorageHandler;

class Inventory {
    private $items = [];
    private $selectedItem = null;

    // Get current inventory, need failsafe!!!
    public function __construct(array $items = []) {
        // $inventory = StorageHandler::getInventoryFromStorage();
        $this->items = $items;
    }

    public function getAllItems(): array {
        return $this->items;
    }

    // Adds item based on the itemData from the room database
    // Define and form it
    public function addItem($itemData) {
        // Push to item array
        $this->items[] = $itemData;
        
        // Should save state here!
        StorageHandler::saveInventory($this->items);        
    }

    public function removeItem($itemName): bool {
        foreach($this->items as $key => $item) {
            if ($item['item'] == $itemName) {
                unset($this->items[$key]);
                $this->items = array_values($this->items);

                if ($this->selectedItem === $key) {
                    $this->selectedItem = null;
                } elseif ($this->selectedItem > $key) {
                    $this->selectedItem--;
                }
                
                return true;
            }
        }
        return false;
    }

    public function select($itemName) {
        // Deselect if other already selected
        if ($this->selectedItem !== null) {
            $this->items[$this->selectedItem]['isSelected'] = false;
        }

        // Select
        foreach($this->items as $key => $item) {
            if ($item['item'] === $itemName) {
                // If same - deselect
                if ($this->selectedItem === $key) {
                    $this->selectedItem = null;
                } else {
                    $this->items[$key]['isSelected'] = true;
                    $this->selectedItem = $key;
                }
                
                // Save state
                StorageHandler::saveInventory($this->items);
                
                return $this->getSelectedItem();
            }
        }

        return null;
    }

    public function getSelectedItem() {
        if ($this->selectedItem !== null && isset($this->items[$this->selectedItem])) {
            return $this->items[$this->selectedItem];
        }

        return null;
    }

    public function clearInventory() {
        $this->items = [];
        $this->selectedItem = null;

        // Save state
        StorageHandler::saveInventory($this->items);
    }

    // Save handling moved to StorageHandler to keep it clean

}