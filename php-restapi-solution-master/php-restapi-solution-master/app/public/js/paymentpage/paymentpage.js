let successAlert = document.querySelector('.alert-success');
let warningAlert = document.querySelector('.alert-warning');

let closeSuccessBtn = successAlert.querySelector('.btn-close');
let closeWarningBtn = warningAlert.querySelector('.btn-close');

let successText = successAlert.querySelector('p');
let warningText = warningAlert.querySelector('p');

const ticketsTableBodyJazz = document.getElementById('tableJazz').getElementsByTagName('tbody')[0];

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
        console.log(data);
        if(data['status'] == 0)
        {
            showWarning(data['message'])
        }
        else{
            if(data['status'] == 1)
            showWarning("Hey, this is your personal program, but you'd need to login to continue!")
            const timeslots = data['tickets'];
            displayTimeslots(timeslots);
        }
    })
    .catch(error => {
        console.error('Error fetching timeslots data:', error);
    });

function displayTimeslots(timeslots) {
    updatePersonalProgram(timeslots);
    ticketsTableBodyJazz.innerHTML = ""; // Clear existing rows
    timeslots.forEach(timeslot => {
        if(timeslot.eventID == 1){
            const timeslotRow = createTimeslotRowJazz(timeslot);
            ticketsTableBodyJazz.appendChild(timeslotRow);
        }
    });
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
function createTimeslotRowJazz(timeslot) {
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
    amountCell.innerHTML = `Amount <br>
    <input type="number" value="${timeslot.quantity}" min="1">
    <button>+</button>
    <button>-</button>`;

    const deleteCell = document.createElement('td');
    deleteCell.innerHTML = `<button>Delete</button>`;

    row.appendChild(artistCell);
    row.appendChild(locationCell);
    row.appendChild(priceCell);
    row.appendChild(amountCell);
    row.appendChild(deleteCell);

    return row;
}

function fillPriceTable(timeslots) {
    const priceTableBody = document.getElementById('priceTableBody');
    priceTableBody.innerHTML = ""; // Clear existing rows
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
    addRowToTable(priceTableBody, 'Subtotal', `€${subtotal.toFixed(2)}`);
    addRowToTable(priceTableBody, 'VAT (9%)', `€${vat.toFixed(2)}`);
    addRowToTable(priceTableBody, 'Total', `€${total.toFixed(2)}`);
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