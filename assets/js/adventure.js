// assets/js/adventure.js

import roomDataJs from '../data/database/game_rooms_for_js.json';

console.log("Adventure game functions detected!")

// Counter tracker
// This works for individual clicker, change from 0
let clickers = {};

function clickedItem(roomNumber, clickedItem) {
    console.log('Room', roomNumber);
    console.log('Item', clickedItem);

    // Need to get the full item data here to access interaction and investigate
    // Made separate database in assets

    let fullItem = findItem(roomNumber, clickedItem);

    if (!fullItem) {
        console.error('No such item in database');
        return null;
    }

    // Remake to taking all vars as arg
    // Need item-specific clickers

    // Create unique clicker position in tuple
    const currentClicker = `${roomNumber}-${clickedItem}`;
    
    // If not in clickers, add
    if (!clickers[currentClicker]) {
        clickers[currentClicker] = 0;
    }

    if (clickers[currentClicker] === 0) {
        clickers[currentClicker] += 1;
        
        // Save message for later retrieval after reload.
        localStorage.setItem('currentMessage', fullItem.look);
        
        showMessage(fullItem.look);

        return fullItem.look;
    } else if (clickers[currentClicker] === 1) {
        clickers[currentClicker] += 1;

        // Save message for later retrieval after reload.
        localStorage.setItem('currentMessage', fullItem.investigate);
        
        // Show message
        showMessage(fullItem.investigate);

        return fullItem.investigate;
    } else if (clickers[currentClicker] === 2) {
        // Reset
        clickers[currentClicker] += 1;

        // Save message for later retrieval after reload.
        localStorage.setItem('currentMessage', fullItem.interact);
        
        // Show message
        showMessage(fullItem.interact);

        // Better to use websockets or just GET to route??
        // addToInventory(roomNumber, clickedItem.name, clickedItem)

        // GET request
        const url = `/project/inventory/add?itemName=${encodeURIComponent(fullItem.item)}&roomNumber=${roomNumber}`;
        console.log('Redirect to: ', url);
        console.log('Item sent: ', fullItem.item);
        console.log('Room ', roomNumber)
        
        window.location.href = url;

        return fullItem.interact;
    } 
    else if (clickers[currentClicker] > 2){
        showMessage("Nothing there");

        return null;
    }
}

function findItem(roomNumber, itemName) {
    const room = roomDataJs.rooms.find(room => room.id === roomNumber);

    if (!room || !room.items) {
        console.error(`Room  ${roomNumber} not found.`);
        return null;
    }

    const item = room.items.find(item => item.item === itemName);

    if (!item) {
        console.error(`Item ${itemName} not found in room`);
        return null;
    }

    return item;
}


function showMessage(message) {
    const infoDisplay = document.getElementById('infoDisplay');

    if (infoDisplay) {
        console.log('Infodisplaying:', message)
        infoDisplay.textContent = message;
        // infoDisplay.style.display = 'block';
    } else {
        console.error("Element not found in html")
    }
}

document.addEventListener('DOMContentLoaded', function() {
    let currentMessage = localStorage.getItem('currentMessage');

    if (currentMessage) {
        showMessage(currentMessage);
        localStorage.removeItem('currentMessage');
    }
})

globalThis.clickedItem = clickedItem;
globalThis.showMessage = showMessage;

export { clickedItem, showMessage, findItem }
