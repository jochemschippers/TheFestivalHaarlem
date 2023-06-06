// <<<<<<<<<<-------------- HIER OVERLAY ---------------->>>>>>>>>>>>
// alert("The file has been reached.");
// console.log("The file has been reached.");

// ADD TO PERSONAL PROGRAM


{/* <div class="modal-body"></div> */}
document.querySelectorAll('.modal-body').forEach(modalBody => {

    const radioButtons = modalBody.querySelectorAll('input[type="radio"]');
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
        const seats = modalBody.querySelector("#seats");
        seats.textContent = availableSeats;
    }

    const aInputField = modalBody.querySelector('.aInputNumber');
    const aMinusButton = modalBody.querySelector(".minusButton");
    const aPlusButton = modalBody.querySelector(".plusButton");

    aMinusButton.addEventListener("click", () => {
        if (aInputField.value > 1) {
            aInputField.value = parseInt(aInputField.value) - 1;
            updateGroupNr(aInputField.value, cInputField.value, modalBody);
        }
    });
    
    aPlusButton.addEventListener("click", () => {
        if (aInputField.value < 20) {
            aInputField.value = parseInt(aInputField.value) + 1;            
            updateGroupNr(aInputField.value, cInputField.value, modalBody);
        }
    });
    
    const cInputField = modalBody.querySelector('.cInputNumber');
    const cMinusButton = modalBody.querySelector(".Cminus-btn");
    const cPlusButton = modalBody.querySelector(".Cplus-btn");

    cMinusButton.addEventListener("click", () => {
        if (cInputField.value > 0) {
            cInputField.value = parseInt(cInputField.value) - 1;
            updateGroupNr(aInputField.value, cInputField.value, modalBody);
        }
    });
    
    cPlusButton.addEventListener("click", () => {
        if (cInputField.value < 20) {
            cInputField.value = parseInt(cInputField.value) + 1;            
            updateGroupNr(aInputField.value, cInputField.value, modalBody);
        }
    });

    

});//end foreach modalBody

function updateGroupNr(adultInput, childInput, modalBody) {
    let groupNr = parseInt(adultInput) + parseInt(childInput);
    modalBody.querySelector("#group").textContent = groupNr;
    modalBody.querySelector("#adults").innerHTML = adultInput;
    modalBody.querySelector("#children").innerHTML = childInput;
    updatePrice(modalBody, groupNr);
}

function updatePrice(modalBody, groupNr) {
    const pricePerPerson = 10;
    const totalPrice = groupNr * pricePerPerson;
    modalBody.querySelector("#price").textContent = totalPrice.toFixed(2);
    modalBody.querySelector("#total-price").textContent = totalPrice.toFixed(2);
}

// ----------------- HIER DE BERICHTEN ------------------
// Get the success and error message elements
const successMessage = document.getElementById("successMessage");
const errorMessage = document.getElementById("errorMessage");
const errorMsg = document.getElementById("errorMsg");

// Set a timer to hide the success message after 3 seconds
setTimeout(function () {
    if (successMessage) {
        successMessage.style.display = 'none';
    }
}, 3000);

// Set a timer to hide the error messages after 5 seconds
setTimeout(function () {
    if (errorMessage) {
        errorMessage.style.display = 'none';
    }
    if (errorMsg) {
        errorMsg.style.display = 'none';
    }
}, 5000);

// Display the message
document.write('<?php echo $message; ?>');
// ----------------- EINDE BERICHTEN ------------------


function checkForm() {
    // Get form input elements
    const customerName = document.getElementById("customerName");
    const phoneNr = document.getElementById("phoneNr");
    const nrAdult = document.getElementById("nrAdult");
    const nrChild = document.getElementById("nrChild");
    const remark = document.getElementById("remark");
    const timeSlot = document.getElementById("btnradio");

    // Validate input
    if (customerName.value.trim() === "") {
        alert("Please enter a valid customer name.");
        customerName.focus();
        return false;
    }
    if (phoneNr.value.trim() === "" || !checkPhoneNumber(phoneNr.value.trim())) {
        alert("Please enter a valid phone number.");
        phoneNr.focus();
        return false;
    }
    if (nrAdult.value.trim() === "" || isNaN(nrAdult.value.trim()) || nrAdult.value.trim() < 1 || nrAdult.value.trim() > 20) {
        alert("Please enter a valid number of adults (1-20).");
        nrAdult.focus();
        return false;
    }
    if (nrChild.value.trim() !== "" && (isNaN(nrChild.value.trim()) || nrChild.value.trim() < 0 || nrChild.value.trim() > 20)) {
        alert("Please enter a valid number of children (0-20).");
        nrChild.focus();
        return false;
    }
    if (remark.value.trim() !== "" && remark.value.trim().length > 200) {
        alert("Please enter a valid remark (maximum 200 characters).");
        remark.focus();
        return false;
    }
    if (timeSlot.value.trim() === "") {
        alert("Please select a time slot.");
        timeSlot.focus();
        return false;
    }

    // Input is valid, submit form

    const quantity = parseInt(nrAdult.value + nrChild.value);
    const ticketID = timeSlot.value;
    let currentMaximum = 20;
    if(getQuantityByID(ticketID) + quantity < currentMaximum)
    {
        addToPersonalProgram(ticketID, quantity);
    }


    // submitForm(() => closeModal());
    // return true;
}

function checkPhoneNumber(phoneNr) {
    const regex = /^((\+31|0)6[-\s]?[1-9](\d[-\s]?){7})$/;
    return regex.test(phoneNr);
}

function submitForm(callback) {
    // Submit form using AJAX or regular form submit
    const form = document.getElementById("#form");
    const formData = new FormData(form);
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            callback();
        }
    };
    xhr.open("POST", form.action, true);
    xhr.send(formData);
}

function closeModal() {
    $("#myModal").modal("hide");
}

document.addEventListener("DOMContentLoaded", function () {
    // Get the modal element
    const modal = document.getElementById("yourModalId");
  
    // When the modal is hidden, reset the form
    modal.addEventListener("hidden.bs.modal", function () {
      resetForm();
    });
  
    function resetForm() {
      // Reset the form
      const form = document.getElementById("form");
      form.reset();
  
      // Reset the reservation details
      document.getElementById("adults").textContent = "1";
      document.getElementById("children").textContent = "0";
      document.getElementById("group").textContent = "1";
      document.getElementById("price").textContent = "10.00";
      document.getElementById("total-price").textContent = "10.00";
      document.getElementById("seats").textContent = "No timeslot selected";
    }
  });