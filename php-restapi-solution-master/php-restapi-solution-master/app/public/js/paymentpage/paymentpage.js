let successAlert = document.querySelector('.alert-success');
let warningAlert = document.querySelector('.alert-warning');

let closeSuccessBtn = successAlert.querySelector('.btn-close');
let closeWarningBtn = warningAlert.querySelector('.btn-close');

let successText = successAlert.querySelector('p');
let warningText = warningAlert.querySelector('p');
let ticketsTableBodyJazz = null
let ticketsTableBodyYummy = null
let timeslots = null;
console.log(window.location.pathname);
if (window.location.pathname.toLowerCase() == "/paymentpage") {
    ticketsTableBodyJazz = document.getElementById('tableJazz').getElementsByTagName('tbody')[0];
    ticketsTableBodyYummy = document.getElementById('tableYummy').getElementsByTagName('tbody')[0];
    verifyCart();
    configureShareButton()
    configureCopyButton();
}
function verifyCart() {
    fetch('paymentpage/getPersonalProgramItems', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            cart: JSON.parse(sessionStorage.getItem('personalProgram') || '[]'),
        })
    }).then(response => response.json())
        .then(data => {
            if (data['status'] == 0) {
                showWarning(data['message'])
                let continueButton = document.getElementById('continueButton');
                continueButton.classList.add('btn-secondary');
                continueButton.classList.remove('btn-primary');
                continueButton.href = 'javascript:void(0)';
                continueButton.textContent = 'Cart is empty!'
            }
            else {
                if (data['status'] == 1)
                    showWarning("Hey there! 👋<br><br>Just a quick heads up! You can review your personal program right here. Take your time," +
                        "make sure everything's in order, and double-check all the details.<br><br>Ready to move forward? Fantastic! But hold on a second..." +
                        "We'll need you to log in to proceed. It's a tiny step that helps us keep everything secure and personalized just for you.<br><br>" +
                        "Enjoy your journey, and let's get you all set up! 😊")
                timeslots = data['tickets'];
                displayTimeslots(timeslots);
            }
        })
        .catch(error => {
            showWarning('Error while loading the personal program. Please try again later.' + error);
        });
}
function configureShareButton() {
    document.getElementById('share-btn').addEventListener('click', () => {
        const link = window.location.origin + '/paymentpage';
        let cartDataString = JSON.stringify(sessionStorage.getItem('personalProgram'));
        let encodedCartData = btoa(cartDataString);
        let shareableUrl = link + "?cart=" + encodedCartData;
        document.getElementById('share-link').value = shareableUrl;

        document.getElementById('share-container').style.display = 'block';
    });
}

function configureCopyButton() {
    document.getElementById('copy-btn').addEventListener('click', () => {
        const shareLinkInput = document.getElementById('share-link');
        shareLinkInput.select();
        document.execCommand('copy');
    });
}

function displayTimeslots(timeslots) {
    updatePersonalProgram(timeslots);

    for (let index = 0; index < timeslots.length; index++) {
        const timeslot = timeslots[index];
        if (timeslot.eventID == 1) {
            const timeslotRow = createTimeslotRowJazz(timeslot, index);
            ticketsTableBodyJazz.appendChild(timeslotRow);
        }
        if (timeslot.eventID == 2) {
            const timeslotRow = createTimeslotRowYummy(timeslot, index); 
            ticketsTableBodyYummy.appendChild(timeslotRow);
        }
    }
    fillPriceTable(timeslots);
}

function updatePersonalProgram(timeslots) {
    //delete the pp from storage
    sessionStorage.setItem('personalProgram', JSON.stringify([]));
    timeslots.forEach(timeslot => {
        addToPersonalProgram(timeslot.timeSlotID, timeslot.quantity, timeslot.reservation);
    });
    sessionStorage.setItem('personalProgram', JSON.stringify(personalProgram));
    updateCartItemDisplay(personalProgram);
}

function createTimeslotRowJazz(timeslot, index) {
    const row = document.createElement('tr');

    const artistCell = createArtistCell(timeslot);
    const locationCell = createLocationCell(timeslot);
    const priceCell = createPriceCell(timeslot);
    const amountCell = createAmountCell(timeslot, index);
    const deleteCell = createDeleteCell(timeslot, index);

    row.appendChild(artistCell);
    row.appendChild(locationCell);
    row.appendChild(priceCell);
    row.appendChild(amountCell);
    row.appendChild(deleteCell);

    return row;
}

function createArtistCell(timeslot) {
    const artistCell = document.createElement('td');
    const options = { month: 'long', day: 'numeric' };
    const startTime = new Date(timeslot.startTime);
    const endTime = new Date(timeslot.endTime);

    artistCell.innerHTML = `${timeslot.artist.name} <br> ${startTime.toLocaleDateString(undefined, options)}, ${startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${endTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;

    return artistCell;
}

function createLocationCell(timeslot) {
    const locationCell = document.createElement('td');
    locationCell.innerHTML = `Location: <br> ${timeslot.jazzLocation.locationName}, ${timeslot.hall.hallName}`;
    return locationCell;
}

function createPriceCell(timeslot) {
    const priceCell = document.createElement('td');
    priceCell.innerHTML = `Total price: <br> €${timeslot.price}`;
    return priceCell;
}

function createAmountCell(timeslot, index) {
    const amountCell = document.createElement('td');
    const amountText = document.createTextNode('Amount');
    const input = document.createElement('input');
    input.type = "number";
    input.value = timeslot.quantity;
    input.min = "1";
    input.max = timeslot.maxTickets;
    input.id = `inputField${index}`;

    appendButtonsToCell(amountCell, index, input);

    return amountCell;
}

function appendButtonsToCell(cell, index, inputField) {
    const minusButton = createButton('-', index, () => updateInputValue(inputField, -1));
    const plusButton = createButton('+', index, () => updateInputValue(inputField, 1));

    cell.appendChild(minusButton);
    cell.appendChild(plusButton);
}

function createButton(text, index, onClick) {
    const button = document.createElement('button');
    button.id = `button${index}`;
    button.className = 'btn btn-primary';
    button.innerText = text;
    button.addEventListener('click', onClick);
    return button;
}

function updateInputValue(inputField, change) {
    const value = parseInt(inputField.value, 10);
    const newValue = value + change;
    if (newValue >= 1) {
        inputField.value = newValue;
    }
}

function createDeleteCell(timeslot, index) {
    const deleteButton = document.createElement('button');
    deleteButton.className = 'btn btn-danger';
    deleteButton.id = `deleteButton${index}`;
    deleteButton.innerText = 'Delete';
    deleteButton.addEventListener('click', function () {
        removeFromPersonalProgram(timeslot.timeSlotID);
        timeslots.splice(timeslots.indexOf(timeslot), 1);
        displayTimeslots(timeslots);
        const rowToDelete = this.parentElement.parentElement;
        fillPriceTable(timeslots);
        rowToDelete.remove();
    });

    const deleteCell = document.createElement('td');
    deleteCell.appendChild(deleteButton);
    return deleteCell;
}

function createTimeslotRowYummy(timeslot, index) {
    const row = document.createElement('tr');

    const restaurantCell = createRestaurantCell(timeslot);
    const locationCell = createYummyLocationCell(timeslot);
    const priceCell = createYummyPriceCell(timeslot);
    const amountCell = createYummyAmountCell(timeslot, index);
    const deleteCell = createYummyDeleteCell(timeslot, index);

    row.appendChild(restaurantCell);
    row.appendChild(locationCell);
    row.appendChild(priceCell);
    row.appendChild(amountCell);
    row.appendChild(deleteCell);

    return row;
}

function createRestaurantCell(timeslot) {
    const restaurantCell = document.createElement('td');
    const options = { month: 'long', day: 'numeric' };
    const startTime = new Date(timeslot.startTime);
    const endTime = new Date(timeslot.endTime);

    restaurantCell.innerHTML = `${timeslot.restaurantName} <br> ${startTime.toLocaleDateString(undefined, options)}, ${startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${endTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;

    return restaurantCell;
}

function createYummyLocationCell(timeslot) {
    const locationCell = document.createElement('td');
    locationCell.innerHTML = `Location: <br> ${timeslot.restaurantName}`;
    return locationCell;
}

function createYummyPriceCell(timeslot) {
    const priceCell = document.createElement('td');
    priceCell.innerHTML = `Total price: <br> €${timeslot.price * timeslot.quantity}`;
    return priceCell;
}

function createYummyAmountCell(timeslot, index) {
    const amountCell = document.createElement('td');
    const amountText = document.createTextNode('Amount:');
    const input = document.createElement('input');
    input.type = "number";
    input.value = timeslot.quantity;
    input.min = "1";
    input.max = "20";
    input.id = `inputFieldYummy${index}`;
    input.disabled = true;

    amountCell.appendChild(amountText);
    amountCell.appendChild( document.createElement('br'));
    amountCell.appendChild(input);

    return amountCell;
}

function createYummyDeleteCell(timeslot, index) {
    const deleteButton = document.createElement('button');
    deleteButton.className = 'btn btn-danger';
    deleteButton.id = `deleteButton${index}`;
    deleteButton.innerText = 'Delete';
    deleteButton.addEventListener('click', function () {
        const rowToDelete = this.parentElement.parentElement;
        timeslots.splice(timeslots.indexOf(timeslot), 1);
        removeFromPersonalProgram(timeslot.timeSlotID);
        fillPriceTable(timeslots);
        rowToDelete.remove();
    });

    const deleteCell = document.createElement('td');
    deleteCell.appendChild(deleteButton);
    return deleteCell;
}
function fillPriceTable(timeslots) {
    const priceTableBody = document.getElementById('priceTableBody');
    priceTableBody.innerHTML = ""; // Clear existing rows

    const { subtotal, vat, total } = calculateTotals(timeslots);


    addRowToTable(priceTableBody, 'Subtotal', `€${subtotal.toFixed(2)}`);
    addRowToTable(priceTableBody, 'VAT (9%)', `€${vat.toFixed(2)}`);
    addRowToTable(priceTableBody, 'Total', `€${total.toFixed(2)}`);
}
function calculateTotals(timeslots) {
    let subtotal = 0;
    let vat = 0;

    timeslots.forEach(timeslot => {
        const total = timeslot.price * timeslot.quantity;
        subtotal += total;
        if (timeslot.eventID !== 2) {
            vat += total * 0.09;
        }
    });

    const total = subtotal + vat;
    return { subtotal, vat, total };
}

function addRowToTable(tableBody, label, value) {
    const row = document.createElement('tr');
    const labelCell = document.createElement('td');
    const valueCell = document.createElement('td');

    labelCell.textContent = label;
    valueCell.textContent = value;

    row.appendChild(labelCell);
    row.appendChild(valueCell);
    tableBody.appendChild(row);
}
function showWarning(message) {
    warningText.innerHTML = `<i class="bi bi-exclamation-triangle-fill"></i> ${message}`;
    warningAlert.classList.remove('d-none');
}

function showSuccess(message) {
    successText.innerHTML = `<i class="bi bi-check-circle-fill"></i> ${message}`;
    successAlert.classList.remove('d-none');
}
function hideWarning() {
    warningAlert.classList.add('d-none');
}

function hideSuccess() {
    successAlert.classList.add('d-none');
}
closeSuccessBtn.addEventListener('click', hideSuccess);
closeWarningBtn.addEventListener('click', hideWarning);