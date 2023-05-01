// <<<<<<<<<<-------------- HIER OVERLAY ---------------->>>>>>>>>>>>

const radioButtons = document.querySelectorAll('input[type="radio"]');
radioButtons.forEach(radioButton => {
    radioButton.addEventListener('click', () => {
        const maxSeats = radioButton.dataset.maxTickets;
        updateSeats(maxSeats);

        // Add checked property to selected radio button
        radioButtons.forEach(rb => {
            rb.checked = (rb === radioButton);
        });
    });
});

function updateSeats(availableSeats) {
    const seats = document.getElementById("seats");
    seats.textContent = availableSeats;
}

const overlayContainer = document.querySelector('.overlay-container');
const overlay = document.querySelector('.overlay');

function showOverlay() {
    overlayContainer.style.display = 'flex';
}

function hideOverlay() {
    overlayContainer.style.display = 'none';
}

hideOverlay();

document.addEventListener('mousedown', (event) => {
    if (!overlayContainer.contains(event.target)) {
        overlayContainer.style.display = 'none';
    }
});

// <<<<<<<<<<-------------- EINDE OVERLAY --------------->>>>>>>>>>>>

// Get the input element and plus/minus buttons
const adultInput = document.getElementById("nrAdult");
const childInput = document.getElementById("nrChild");

adultInput.addEventListener("change", function (event) {
    // If the input value is above the max value, set it to the max value
    if (adultInput.value > parseInt(adultInput.max)) {
        adultInput.value = adultInput.max;
    }
    if (adultInput.value < adultInput.min) {
        adultInput.value = adultInput.min;
    }
    document.getElementById("adults").textContent = adultInput.value;
    updateGroupNr();
});

childInput.addEventListener("change", function (event) {
    // If the input value is above the max value, set it to the max value
    if (childInput.value > parseInt(childInput.max)) {
        childInput.value = childInput.max;
    }
    if (childInput.value < childInput.min) {
        childInput.value = childInput.min;
    }
    document.getElementById("children").textContent = childInput.value;
    updateGroupNr();
});
// <<<<<<<<-------------- HIER PLUS EN MIN KNOPPEN ------------>>>>>>>>
const aMinusBtn = document.querySelector(".Aminus-btn");
const aPlusBtn = document.querySelector(".Aplus-btn");

const cMinusBtn = document.querySelector(".Cminus-btn");
const cPlusBtn = document.querySelector(".Cplus-btn");

// Add event listeners to plus/minus buttons of Adult
aMinusBtn.addEventListener("click", () => {
    if (adultInput.value > 1) {
        adultInput.value = parseInt(adultInput.value) - 1;
        document.getElementById("adults").textContent = adultInput.value;
        updateGroupNr();
    }
});

aPlusBtn.addEventListener("click", () => {
    if (adultInput.value < 20) {
        adultInput.value = parseInt(adultInput.value) + 1;
        document.getElementById("adults").textContent = adultInput.value;
        updateGroupNr();
    }
});

// Add event listeners to plus/minus buttons of Child
cMinusBtn.addEventListener("click", () => {
    if (childInput.value > 0) {
        childInput.value = parseInt(childInput.value) - 1;
        document.getElementById("children").textContent = childInput.value;
        updateGroupNr();
    }
});

cPlusBtn.addEventListener("click", () => {
    if (childInput.value < 20) {
        childInput.value = parseInt(childInput.value) + 1;
        document.getElementById("children").textContent = childInput.value;
        updateGroupNr();
    }
});
// <<<<<<<<---------------- EINDE KNOPPEN ------------------>>>>>>>>>

function updateGroupNr() {
    groupNr = parseInt(adultInput.value) + parseInt(childInput.value);
    document.getElementById("group").textContent = groupNr;
    updatePrice();
}

function updatePrice() {
    const groupSize = parseInt(adultInput.value) + parseInt(childInput.value);
    const pricePerPerson = 10;
    const totalPrice = groupSize * pricePerPerson;
    document.getElementById("price").textContent = totalPrice.toFixed(2);
    document.getElementById("total-price").textContent = totalPrice.toFixed(2);
}

// Get the success and error message elements
const successMessage = document.getElementById("successMessage");
const errorMessage = document.getElementById("errorMessage");
const errorMsg = document.getElementById("errorMsg");

// Set a timer to hide the success message after 3 seconds
setTimeout(function() {
    if (successMessage) {
        successMessage.style.display = 'none';
    }
}, 3000);

// Set a timer to hide the error messages after 5 seconds
setTimeout(function() {
    if (errorMessage) {
        errorMessage.style.display = 'none';
    }
    if (errorMsg) {
        errorMsg.style.display = 'none';
    }
}, 5000);

// Display the message
document.write('<?php echo $message; ?>');