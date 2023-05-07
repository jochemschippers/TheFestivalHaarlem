const addButtonElements = document.querySelectorAll('.add-button');
const ticketModal = new bootstrap.Modal(document.getElementById('ticketModal'));
const ticketDateElement = document.getElementById('ticketDate');
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

addButtonElements.forEach(addButton => {
    addButton.addEventListener('click', function () {
        ticketInfo = JSON.parse(this.dataset.ticketInfo);
        ticketDateElement.textContent = ticketInfo.date;
        ticketArtist.textContent = ticketInfo.artistName;
        ticketTimeRange.textContent = ticketInfo.timeRange;
        ticketLocationElement.textContent = ticketInfo.location;
        ticketPriceElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
        ticketTotalElement.textContent = '€' + parseFloat(ticketInfo.price).toFixed(2);
        console.log(ticketInfo.colorID);
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

plusButton.addEventListener("click", () => {
    ticketQuantity.value = parseInt(ticketQuantity.value) + 1;
    updateTicketTotal();
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
    addToPersonalProgram(ticketInfo.timeSlotID, quantity);

    ticketModal.hide();
});

const cancelButton = document.getElementById("cancel");
cancelButton.addEventListener("click", () => {
    ticketModal.hide();
});
// ticketModal.addEventListener("show.bs.modal", () => {
//     carouselSchedule.carousel("pause");
// });

// ticketModal.addEventListener("hidden.bs.modal", () => {
//     carouselSchedule.carousel("cycle");
// });