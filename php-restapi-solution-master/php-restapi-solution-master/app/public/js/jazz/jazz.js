const addButtonElements = document.querySelectorAll('.add-button');
const ticketModal = new bootstrap.Modal(document.getElementById('ticketModal'));
const ticketDateElement = document.getElementById('ticketDate');
const ticketsLeft = document.getElementById('tickets-left');
const ticketLocationElement = document.getElementById('ticketLocation');
const ticketArtist = document.getElementById('ticketArtist');
const ticketTimeRange = document.getElementById('ticketTimeRange');
const ticketPriceElement = document.getElementById('ticketPrice');
const ticketQuantityElement = document.getElementById('ticketQuantity');
const ticketTotalElement = document.getElementById('ticketTotal');
const minusButton = document.getElementById('minusButton');
const plusButton = document.getElementById('plusButton');
const dateLocation = document.getElementById('date-location');
const carouselSchedule = document.getElementById('scheduleCarousel');
let ticketInfo;
let currentMaximum;
//for getting last possible date:
const carouselItems = document.querySelectorAll('.carousel-item');
const lastCarouselItem = carouselItems[carouselItems.length - 1];
const lastCarouselItemDateStr = lastCarouselItem.querySelector('h3').textContent;
const lastCarouselItemDate = this.parseDateString(lastCarouselItemDateStr);

addButtonElements.forEach(addButton => {
    addButton.addEventListener('click', function () {
        ticketInfo = JSON.parse(this.dataset.ticketInfo);
        if (lastCarouselItemDate.getDate() === parseDateString(ticketInfo.date).getDate()) {
            return;
        }
        ticketDateElement.textContent = ticketInfo.date;
        ticketArtist.textContent = ticketInfo.artistName;
        ticketTimeRange.textContent = ticketInfo.timeRange;
        ticketLocationElement.textContent = ticketInfo.location;
        ticketPriceElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
        ticketTotalElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
        ticketsLeft.innerHTML = "tickets left: " + ticketInfo.ticketsLeft;
        ticketQuantityElement.max = ticketInfo.ticketsLeft;
        currentMaximum = ticketInfo.ticketsLeft;
        ticketQuantityElement.value = 1;
        if (ticketInfo.colorID == 0) {
            dateLocation.classList.remove("secondary-ticket");
            dateLocation.classList.add("primary-ticket");
        }
        else {
            dateLocation.classList.remove("primary-ticket");
            dateLocation.classList.add("secondary-ticket");
        }
        ticketModal.show();
    });
});

const dayTicketButtons = document.querySelectorAll('#day-ticket');
dayTicketButtons.forEach(dayTicketButton => {
    dayTicketButton.addEventListener('click', function () {
        ticketInfo = JSON.parse(this.dataset.ticketInfo);

        ticketDateElement.textContent = ticketInfo.date;
        ticketArtist.textContent = ticketInfo.artistName !== 'Day ticket' ? ticketInfo.artistName : 'Day Ticket';
        ticketTimeRange.textContent = ticketInfo.timeRange !== 'Day ticket' ? ticketInfo.timeRange : 'Not Applicable';
        ticketLocationElement.textContent = ticketInfo.location !== 'Day ticket' ? ticketInfo.location : 'Not Applicable';
        ticketPriceElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
        ticketTotalElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
        ticketsLeft.innerHTML = "tickets left: " + ticketInfo.ticketsLeft;
        ticketQuantityElement.max = ticketInfo.ticketsLeft;
        currentMaximum = ticketInfo.ticketsLeft;
        ticketQuantityElement.value = 1;

        if (ticketInfo.colorID == 0) {
            dateLocation.classList.remove("secondary-ticket");
            dateLocation.classList.add("primary-ticket");
        } else {
            dateLocation.classList.remove("primary-ticket");
            dateLocation.classList.add("secondary-ticket");
        }

        ticketModal.show();
    });
});
const weekTicketButtons = document.querySelectorAll('#week-ticket');
weekTicketButtons.forEach(weekTicketButton => {
weekTicketButton.addEventListener('click', function () {
    ticketInfo = JSON.parse(this.dataset.ticketInfo);

    ticketDateElement.textContent = ticketInfo.date;
    ticketArtist.textContent = ticketInfo.artistName !== 'Day ticket' ? ticketInfo.artistName : 'Day Ticket';
    ticketTimeRange.textContent = ticketInfo.timeRange !== 'Day ticket' ? ticketInfo.timeRange : 'Not Applicable';
    ticketLocationElement.textContent = ticketInfo.location !== 'Day ticket' ? ticketInfo.location : 'Not Applicable';
    ticketPriceElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
    ticketTotalElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
    ticketsLeft.innerHTML = "tickets left: " + ticketInfo.ticketsLeft;
    ticketQuantityElement.max = ticketInfo.ticketsLeft;
    currentMaximum = ticketInfo.ticketsLeft;
    ticketQuantityElement.value = 1;

    if (ticketInfo.colorID == 0) {
        dateLocation.classList.remove("secondary-ticket");
        dateLocation.classList.add("primary-ticket");
    } else {
        dateLocation.classList.remove("primary-ticket");
        dateLocation.classList.add("secondary-ticket");
    }

    ticketModal.show();
});
});
plusButton.addEventListener("click", () => {
    const ticketQuantityValue = parseInt(ticketQuantity.value);
    const ticketsLeft = parseInt(ticketInfo.ticketsLeft);
    if (ticketQuantityValue < ticketsLeft) {
        ticketQuantity.value = ticketQuantityValue + 1;
        updateTicketTotal();
    }
});

minusButton.addEventListener("click", () => {
    if (ticketQuantity.value > 1) {
        ticketQuantity.value = parseInt(ticketQuantity.value) - 1;
        updateTicketTotal();
    }
});

ticketQuantity.addEventListener("change", updateTicketTotal);
function updateTicketTotal() {
    const price = parseFloat(ticketPrice.textContent.slice(1));
    const quantity = parseInt(ticketQuantity.value);
    const total = price * quantity;
    ticketTotal.textContent = "€" + total.toFixed(2);
}

const addToProgramButton = document.getElementById("addToProgram");
addToProgramButton.addEventListener("click", () => {
    const quantity = parseInt(ticketQuantity.value);
    const ticketID = ticketInfo.timeSlotID;
    if (getQuantityByID(ticketID) + quantity < currentMaximum) {
        addToPersonalProgram(ticketInfo.timeSlotID, quantity);
    }
    ticketModal.hide();
});

const cancelButton = document.getElementById("cancel");
cancelButton.addEventListener("click", () => {
    ticketModal.hide();
});

function parseDateString(dateString) {
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'];

    // Use regex to extract day, month and (optionally) year
    const dateRegex = /\b(\d{1,2})(st|nd|rd|th)?\s+(of\s+)?([a-zA-Z]+)(\s*,?\s*\d{4})?\b/;
    const matches = dateString.match(dateRegex);

    if (!matches) {
        throw new Error('Invalid date format');
    }

    const day = parseInt(matches[1], 10);
    const month = monthNames.indexOf(matches[4]);
    const year = matches[5] ? parseInt(matches[5], 10) : new Date().getFullYear();

    if (month === -1 || day < 1 || day > 31) {
        throw new Error('Invalid date components');
    }

    return new Date(year, month, day);
}

