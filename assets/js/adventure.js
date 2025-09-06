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

    if (fullItem.item === "forklift") {
        objectInteraction(roomNumber, fullItem.item);
        return fullItem.interact;
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

        // Check for radio and forklift to call objectInteraction
        if (fullItem.item === "radio") {
            console.log("Radio call objectInteraction")
            objectInteraction(roomNumber, fullItem.item)
            
            // Check for audio
            if(fullItem.audio) {
                console.log("Audio param found in item, this is a mood setter.");
                playAudio(fullItem.audio);
                return;
            }
        } else if (fullItem.item === "forklift") {
            console.log("Forklift call objectInteraction")
            objectInteraction(roomNumber, fullItem.item)
            return fullItem.interact
        } else if (fullItem.item === "x") {
            console.log("X call objectInteraction")
            objectInteraction(roomNumber, fullItem.item)
            return fullItem.interact
        }
        
        // Show message
        localStorage.setItem('currentMessage', fullItem.interact);
        showMessage(fullItem.interact);

        // GET request
        const url = `/project/inventory/add?itemName=${encodeURIComponent(fullItem.item)}&roomNumber=${roomNumber}`;
        console.log('Redirect to: ', url);
        console.log('Item sent: ', fullItem.item);
        console.log('Room ', roomNumber)
        window.location.href = url;
        
        return fullItem.interact
    } else if (clickers[currentClicker] > 2) {
        clickers[currentClicker] += 1;

        // This for all others when clicked three times already
        showMessage(fullItem.interact);
        
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

            if (data.redirectTo) {
                window.location.href = `/project/${data.redirectTo}`;
                return;
            }
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

function playAudio(trackName) {
    console.log("Jukebox replies, selecting record");

    // Create jukebox
    const jukebox = document.createElement('audio');
    console.log(`Element created`);
    console.log(`Track ${trackName}`)

    jukebox.src = `/assets/audio/${trackName}`;
    jukebox.preload = 'auto';
    jukebox.controls = false;
    jukebox.volume = 0.5;

    // Add to DOM
    jukebox.style.display = 'none';
    document.body.appendChild(jukebox);

    jukebox.play().catch(error => {
        console.log('Could not play audio');
    })

    jukebox.addEventListener('ended', () => {
        document.body.removeChild(jukebox);
    })
}

function clearClickers() {
    console.log("Clearing clickers..")
    for (let i = localStorage.length - 1; i >= 0; i--) {
        let key = localStorage.key(i);

        if (key && key.includes('-') && !key.includes('.')) {
            console.log("Removing", key);
            localStorage.removeItem(key);
        }
    }

    localStorage.removeItem('currentMessage');

    // Reset clickers object
    clickers = {};

    console.log("Clickers cleared on reset");
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
globalThis.playAudio = playAudio;
globalThis.clearClickers = clearClickers;

export { clickedItem, showMessage, findItem, objectInteraction, selectInventoryItem, playAudio, clearClickers }
