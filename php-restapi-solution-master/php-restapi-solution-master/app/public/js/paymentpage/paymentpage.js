let successAlert = document.querySelector('.alert-success');
let warningAlert = document.querySelector('.alert-warning');

let closeSuccessBtn = successAlert.querySelector('.btn-close');
let closeWarningBtn = warningAlert.querySelector('.btn-close');

let successText = successAlert.querySelector('p');
let warningText = warningAlert.querySelector('p');
let ticketsTableBodyJazz = null
let ticketsTableBodyYummy = null
console.log(window.location.pathname);
if (window.location.pathname == "/paymentpage") {
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
                const timeslots = data['tickets'];
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

// function displayTimeslots(timeslots) {
//     updatePersonalProgram(timeslots);
//     ticketsTableBodyJazz.innerHTML = ""; // Clear existing rows
//     ticketsTableBodyYummy.innerHTML = ""; // Clear existing rows
//     timeslots.forEach(timeslot => {
//         if (timeslot.eventID == 1) {
//             const timeslotRow = createTimeslotRowJazz(timeslot);
//             ticketsTableBodyJazz.appendChild(timeslotRow);
//         }
//         if (timeslot.eventID == 2) {
//             const timeslotRow = createTimeslotRowYummy(timeslot);
//             ticketsTableBodyYummy.appendChild(timeslotRow);
//         }
//     });
//     fillPriceTable(timeslots);
// }

function displayTimeslots(timeslots) {
    updatePersonalProgram(timeslots);
    ticketsTableBodyJazz.innerHTML = ""; // Clear existing rows
    ticketsTableBodyYummy.innerHTML = ""; // Clear existing rows

    for (let index = 0; index < timeslots.length; index++) {
        const timeslot = timeslots[index];
        if (timeslot.eventID == 1) {
            const timeslotRow = createTimeslotRowJazz(timeslot, index);
            ticketsTableBodyJazz.appendChild(timeslotRow);
        }
        if (timeslot.eventID == 2) {
            const timeslotRow = createTimeslotRowYummy(timeslot, index); // call naar restaurant reservering info toevoegen.
            ticketsTableBodyYummy.appendChild(timeslotRow);
        }
    }
    fillPriceTable(timeslots);
}

function updatePersonalProgram(timeslots) {
    //delete the pp from storage
    sessionStorage.setItem('personalProgram', JSON.stringify([]));
    timeslots.forEach(timeslot => {
        console.log(timeslot);
        addToPersonalProgram(timeslot.timeSlotID, timeslot.quantity);
    });
    sessionStorage.setItem('personalProgram', JSON.stringify(personalProgram));
    updateCartItemDisplay(personalProgram);
}

function createTimeslotRowJazz(timeslot, index) {
    const row = document.createElement('tr');

    const options = { month: 'long', day: 'numeric' };
    const startTime = new Date(timeslot.startTime);
    const endTime = new Date(timeslot.endTime);

    const artistCell = document.createElement('td');
    artistCell.innerHTML = `${timeslot.artist.name} <br> ${startTime.toLocaleDateString(undefined, options)}, ${startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${endTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;

    const locationCell = document.createElement('td');
    locationCell.innerHTML = `Location: <br> ${timeslot.jazzLocation.locationName}, ${timeslot.hall.hallName}`;

    const priceCell = document.createElement('td');
    priceCell.innerHTML = `Total price: <br> €${timeslot.price}`;

    const amountCell = document.createElement('td');
    const amountText = document.createTextNode('Amount');
    const input = document.createElement('input');
    input.type = "number";
    input.value = timeslot.quantity;
    input.min = "1";
    input.max = timeslot.maxTickets;
    input.id = `inputField${index}`;
    const minusButton = document.createElement('button');
    minusButton.id = `minusButton${index}`;
    minusButton.className = 'btn btn-primary';
    minusButton.innerText = '-';
    minusButton.addEventListener('click', function () {
        var inputField = document.getElementById(`inputField${index}`);
        if (parseInt(inputField.value, 10) > 1) {
            inputField.value = parseInt(inputField.value, 10) - 1;
        }
    });
    const plusButton = document.createElement('button');
    plusButton.id = `plusButton${index}`;
    plusButton.className = 'btn btn-primary';
    plusButton.innerText = '+';
    plusButton.addEventListener('click', function () {
        var inputField = document.getElementById(`inputField${index}`);
        inputField.value = parseInt(inputField.value, 10) + 1;
    });
    amountCell.appendChild(amountText);
    amountCell.appendChild(input);
    amountCell.appendChild(plusButton);
    amountCell.appendChild(minusButton);

    const deleteButton = document.createElement('button');
    deleteButton.className = 'btn btn-danger';
    deleteButton.id = `deleteButton${index}`;
    deleteButton.innerText = 'Delete';
    deleteButton.addEventListener('click', function () {
        // Delete the timeslot from the timeslots array
        timeslots.splice(timeslots.indexOf(timeslot), 1);
        // Redraw the table
        displayTimeslots(timeslots);
    });

    const deleteCell = document.createElement('td');
    deleteCell.appendChild(deleteButton); // Append the delete button to the deleteCell

    row.appendChild(artistCell);
    row.appendChild(locationCell);
    row.appendChild(priceCell);
    row.appendChild(amountCell);
    row.appendChild(deleteCell);
    return row;
}

// const deleteButton = document.createElement('button');
//     deleteButton.className = 'btn btn-danger';
//     deleteButton.id = `deleteButton${index}`;
//     deleteButton.innerText = 'Delete';
//     deleteButton.addEventListener('click', function () {
//         // Filter the timeslot out of the timeslots array
//         let updatedTimeslots = timeslots.filter(ts => ts !== timeslot);
//         // Redraw the table
//         displayTimeslots(updatedTimeslots);
//     });

//     const deleteCell = document.createElement('td');
//     deleteCell.appendChild(deleteButton); // Append the delete button to the deleteCell

//     row.appendChild(artistCell);
//     row.appendChild(locationCell);
//     row.appendChild(priceCell);
//     row.appendChild(amountCell);
//     row.appendChild(deleteCell);

// function createTimeslotRowJazz(timeslot) {
//     const row = document.createElement('tr');

//     const options = { month: 'long', day: 'numeric' };
//     const startTime = new Date(timeslot.startTime);
//     const endTime = new Date(timeslot.endTime);

//     const artistCell = document.createElement('td');
//     artistCell.innerHTML = `${timeslot.artist.name} <br> ${startTime.toLocaleDateString(undefined, options)}, ${startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${endTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;

//     const locationCell = document.createElement('td');
//     locationCell.innerHTML = `Location: <br> ${timeslot.jazzLocation.locationName}, ${timeslot.hall.hallName}`;

//     const priceCell = document.createElement('td');
//     priceCell.innerHTML = `Total price: <br> €${timeslot.price}`;

//     const amountCell = document.createElement('td');
//     amountCell.innerHTML = `
//     Amount <br>
//     <input type="number" id="inputField" value="${timeslot.quantity}" min="1">
//     <button id="plusButton" class="btn btn-primary">+</button>
//     <button id="minusButton" class="btn btn-primary">-</button>
//     `;

//     const deleteCell = document.createElement('td');
//     deleteCell.innerHTML = `<button class="btn btn-danger">Delete</button>`;

//     row.appendChild(artistCell);
//     row.appendChild(locationCell);
//     row.appendChild(priceCell);
//     row.appendChild(amountCell);
//     row.appendChild(deleteCell);

//     return row;
// }

function createTimeslotRowYummy(timeslot, index) { //YUMMY TIMESLOT
    const row = document.createElement('tr');

    const options = { month: 'long', day: 'numeric' };
    const startTime = new Date(timeslot.startTime);
    const endTime = new Date(timeslot.endTime);

    const restaurantCell = document.createElement('td');
    restaurantCell.innerHTML = `${timeslot.restaurant} <br> ${startTime.toLocaleDateString(undefined, options)}, ${startTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${endTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}`;

    const locationCell = document.createElement('td');
    locationCell.innerHTML = `Location: <br> ${timeslot.restaurantName}`;

    const priceCell = document.createElement('td');
    priceCell.innerHTML = `Total price: <br> €${timeslot.price}`;

    const amountCell = document.createElement('td');
    const amountText = document.createTextNode('Amount');
    const input = document.createElement('input');
    input.type = "number";
    input.value = timeslot.quantity;
    input.min = "1";
    input.max = "20";
    input.id = `inputFieldYummy${index}`;

    const minusButton = document.createElement('button');
    minusButton.id = `minusButtonYummy${index}`;
    minusButton.className = 'btn btn-primary';
    minusButton.innerText = '-';
    minusButton.addEventListener('click', function () {
        var inputField = document.getElementById(`inputFieldYummy${index}`);
        if (parseInt(inputField.value, 10) > 1) {
            inputField.value = parseInt(inputField.value, 10) - 1;
        }
    });
    const plusButton = document.createElement('button');
    plusButton.id = `plusButtonYummy${index}`;
    plusButton.className = 'btn btn-primary';
    plusButton.innerText = '+';
    plusButton.addEventListener('click', function () {
        var inputField = document.getElementById(`inputFieldYummy${index}`);
        inputField.value = parseInt(inputField.value, 10) + 1;
    });


    amountCell.appendChild(amountText);
    amountCell.appendChild(input);
    amountCell.appendChild(plusButton);
    amountCell.appendChild(minusButton);

    const deleteButton = document.createElement('button');
    deleteButton.className = 'btn btn-danger';
    deleteButton.id = `deleteButton${index}`;
    deleteButton.innerText = 'Delete';
    deleteButton.addEventListener('click', function () {
        // Delete the timeslot from the timeslots array
        timeslots.splice(timeslots.indexOf(timeslot), 1);
        // Redraw the table
        displayTimeslots(timeslots);
    });

    const deleteCell = document.createElement('td');
    deleteCell.appendChild(deleteButton); // Append the delete button to the deleteCell

    row.appendChild(restaurantCell);
    row.appendChild(locationCell);
    row.appendChild(priceCell);
    row.appendChild(amountCell);
    row.appendChild(deleteCell);

    return row;
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