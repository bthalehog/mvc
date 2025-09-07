<?php

namespace App\Proj;

use App\Proj\StorageHandler;

/**
 * Handles items in game inventory
 */
class Inventory {
    private $items = [];
    private $selectedItem = null;

    /**
     * Get current inventory,.
     * @return void
     */
    public function __construct(array $items = []) {
        // $inventory = StorageHandler::getInventoryFromStorage();
        $this->items = $items;
    }

    /**
     * Get all items
     * @return array as representation of items in inventory.
     */
    public function getAllItems(): array {
        return $this->items;
    }

    /**
     * Add item to inventory
     * @return string as confirmation "Item added".
     */
    public function addItem($itemData) {
        // Push to item array
        $this->items[] = $itemData;
        
        return "Item added";
    }

    /**
     * Remove item from
     * @return bool
     */
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

    /**
     * Select item in inventory
     * @return array objectData.
     */
    public function select($itemName) {
        // echo "Selecting" . $itemName . "<br>";

        // Deselect if other already selected
        if ($this->selectedItem !== null) {
            $this->items[$this->selectedItem]['isSelected'] = false;
        }

        // Select
        foreach($this->items as $key => $item) {
            if ($item['item'] === $itemName) {
                // echo "Found" . $itemName . "<br>";

                // If same - deselect
                if ($this->selectedItem === $key) {
                    $this->selectedItem = null;
                    // echo "Deselected" . $itemName . "<br>";
                } else {
                    $this->items[$key]['isSelected'] = true;
                    $this->selectedItem = $key;
                    // echo "Selected" . $itemName . "<br>";
                }
                
                return $this->getSelectedItem();
            }
        }

        // echo "Not found" . $itemName . "<br>";

        return null;
    }

    /**
     * Get selected item
     * @return array of itemData.
     */
    public function getSelectedItem() {
        if ($this->selectedItem !== null && isset($this->items[$this->selectedItem])) {
            return $this->items[$this->selectedItem];
        }

        return null;
    }

    /**
     * Clear inventory
     * @return void
     */
    public function clearInventory() {
        $this->items = [];
        $this->selectedItem = null;
    }
}
