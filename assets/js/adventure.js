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

    // Create unique clicker position in tuple
    const currentClicker = `${roomNumber}-${clickedItem}`;

    // Load clicker from localStorage
    const clickSave = localStorage.getItem(`${currentClicker}`);

    if (clickSave !== null) {
        clickers[currentClicker] = parseInt(clickSave);
    } else {
        clickers[currentClicker] = 0;
    }

    if (clickers[currentClicker] === 0) {
        clickers[currentClicker] += 1;
        
        // Save message for later retrieval after reload.
        localStorage.setItem('currentMessage', fullItem.look);
        
        // Persist clicker
        localStorage.setItem(`${currentClicker}`, clickers[currentClicker].toString());
        
        showMessage(fullItem.look);

        return fullItem.look;
    } else if (clickers[currentClicker] === 1) {
        clickers[currentClicker] += 1;

        // Save message for later retrieval after reload.
        localStorage.setItem('currentMessage', fullItem.investigate);

        // Persist clicker
        localStorage.setItem(`${currentClicker}`, clickers[currentClicker].toString());
        
        // Show message
        showMessage(fullItem.investigate);

        return fullItem.investigate;
    } else if (clickers[currentClicker] === 2) {
        clickers[currentClicker] += 1;

        // Save message for later retrieval after reload.
        localStorage.setItem('currentMessage', fullItem.interact);

        // Persist clicker
        localStorage.setItem(`${currentClicker}`, clickers[currentClicker].toString());
        
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
        clickers[currentClicker] += 1;

        showMessage("Nothing there");
        
        // Persist clicker
        localStorage.setItem(`${currentClicker}`, clickers[currentClicker].toString());

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
    const infoDisplay = document.querySelector('#infoDisplay');

    if (infoDisplay) {
        console.log('Info-displaying:', message)
        infoDisplay.textContent = message;
    } else {
        console.error("Element not found in html")
    }
}

function objectInteraction(roomId, itemName) {
    // Get full item data
    let currentItem = findItem(roomId, itemName);
    
    // Show message -- This will fail now..
    if (currentItem) {
        showMessage(currentItem.look);
    }

    // GET to route for object interaction
    fetch(`/project/api/objectInteraction/${roomId}/${encodeURIComponent(itemName)}`)
    .then(response => {
        console.log("Response status:", response.status);
        console.log("Response headers:", response.headers);
        
        if (!response.ok) {
            throw new Error('Error in interaction js')
        }

        return response.text();
    })
    .then(text => {
        console.log("Raw response:", text);

        try {
            const data = JSON.parse(text);
            showMessage(data.infoDisplay || data.message);
        } catch (error) {
            console.error("JSON PARSE FAIL", error);
            showMessage("JSON error in js");
        }
    })
    .catch(error => {
        console.error("Error: ", error);
        showMessage("Error in interaction js");
    })
}

function selectInventoryItem(itemName) {
    fetch(`/project/inventory`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `selectedItem=${encodeURIComponent(itemName)}`
    })
    .then(response => {
        if (response.ok) {
            document.querySelectorAll('.gameItem').forEach(item => {
                item.classList.remove('selected');
            });
            document.getElementById(`item${itemName}`).classList.add('selected');
        }
    })
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
globalThis.objectInteraction = objectInteraction;

export { clickedItem, showMessage, findItem, objectInteraction, selectInventoryItem }
