
document.addEventListener('DOMContentLoaded', (event) => {
  const table = document.querySelector('#timeSlotsTable');
  const select = document.querySelector('#rows-per-page');
  let currentPage = 1;

  // Add page navigation elements
  const pagination = document.createElement('div');
  const prevButton = document.createElement('button');
  const nextButton = document.createElement('button');
  prevButton.textContent = 'Previous';
  nextButton.textContent = 'Next';
  pagination.appendChild(prevButton);
  pagination.appendChild(nextButton);
  table.parentElement.appendChild(pagination);

  const updateTable = () => {
    const rowsPerPage = parseInt(select.value);
    const rows = table.querySelectorAll('tbody tr');
    const totalPages = Math.ceil(rows.length / rowsPerPage);
    
    // Update visibility of rows
    for (let i = 0; i < rows.length; i++) {
      if (Math.floor(i / rowsPerPage) + 1 === currentPage) {
        rows[i].style.display = 'table-row';
      } else {
        rows[i].style.display = 'none';
      }
    }

    // Update visibility and functionality of page navigation buttons
    prevButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === totalPages;
    prevButton.onclick = () => { currentPage--; updateTable(); };
    nextButton.onclick = () => { currentPage++; updateTable(); };
  };

  // Handle change of rows per page
  select.addEventListener('change', () => {
    currentPage = 1;
    updateTable();
  });

  // Initial table update
  updateTable();
});
// ----------------- EINDE TABEL FILTER ------------------

// ----------------- HIER DE EDITRESTAURANT CHECKEN ------------------
function checkEditRestaurantForm() {
  // Get form input elements
  const editRestaurantName = document.getElementById("editRestaurantName");
  const editRestaurantAddress = document.getElementById("editRestaurantAddress");
  const editRestaurantContact = document.getElementById("editRestaurantContact");
  const editRestaurantCardDescription = document.getElementById("editRestaurantCardDescription");
  const editRestaurantDescription = document.getElementById("editRestaurantDescription");
  const editRestaurantAmountOfStars = document.getElementById("editRestaurantAmountOfStars");
  const editRestaurantBannerImage = document.getElementById("editRestaurantBannerImage");
  const editRestaurantHeadChef = document.getElementById("editRestaurantHeadChef");
  const editRestaurantAmountSessions = document.getElementById("editRestaurantAmountSessions");
  const editRestaurantAdultPrice = document.getElementById("editRestaurantAdultPrice");
  const editRestaurantChildPrice = document.getElementById("editRestaurantChildPrice");

  // Validate input
  if (editRestaurantName.value.trim() === "") {
    alert("Please enter a valid restaurant name.");
    editRestaurantName.focus();
    return false;
  }
  if (editRestaurantAddress.value.trim() === "") {
    alert("Please enter a valid restaurant address.");
    editRestaurantAddress.focus();
    return false;
  }
  if (editRestaurantContact.value.trim() === "" || isNaN(editRestaurantContact.value.trim())) {
    alert("Please enter a valid restaurant contact.");
    editRestaurantContact.focus();
    return false;
  }
  if (editRestaurantCardDescription.value.trim() === "") {
    alert("Please enter a valid restaurant card description.");
    editRestaurantCardDescription.focus();
    return false;
  }
  if (editRestaurantDescription.value.trim() === "") {
    alert("Please enter a valid restaurant description.");
    editRestaurantDescription.focus();
    return false;
  }
  if (editRestaurantAmountOfStars.value.trim() === "" || isNaN(editRestaurantAmountOfStars.value.trim())) {
    alert("Please enter a valid amount of stars for the restaurant.");
    editRestaurantAmountOfStars.focus();
    return false;
  }
  if (editRestaurantBannerImage.value.trim() === "") {
    alert("Please enter a valid restaurant banner image URL.");
    editRestaurantBannerImage.focus();
    return false;
  }
  if (editRestaurantHeadChef.value.trim() === "") {
    alert("Please enter a valid restaurant head chef name.");
    editRestaurantHeadChef.focus();
    return false;
  }
  if (editRestaurantAmountSessions.value.trim() === "" || isNaN(editRestaurantAmountSessions.value.trim())) {
    alert("Please enter a valid amount of sessions for the restaurant.");
    editRestaurantAmountSessions.focus();
    return false;
  }
  if (editRestaurantAdultPrice.value.trim() === "" || isNaN(editRestaurantAdultPrice.value.trim())) {
    alert("Please enter a valid price for adults.");
    editRestaurantAdultPrice.focus();
    return false;
  }
  if (editRestaurantChildPrice.value.trim() === "" || isNaN(editRestaurantChildPrice.value.trim())) {
    alert("Please enter a valid price for children.");
    editRestaurantChildPrice.focus();
    return false;
  }

  // Input is valid, submit form
  submitForm(() => closeModal());
  return true;
}
// ----------------- EINDE EDITRESTAURANT CHECKEN ------------------

// ----------------- HIER DE ADDRESTAURANT CHECKEN ------------------
function checkAddRestaurantForm() {
  const nameInput = document.getElementById("createRestaurant-name");
  const addressInput = document.getElementById("createRestaurant-address");
  const contactInput = document.getElementById("createRestaurant-contact");
  const cardDescriptionInput = document.getElementById("createRestaurant-cardDescription");
  const descriptionInput = document.getElementById("createRestaurant-description");
  const amountOfStarsInput = document.getElementById("createRestaurant-amountOfStars");
  const bannerImageInput = document.getElementById("createRestaurant-bannerImage");
  const headChefInput = document.getElementById("createRestaurant-headChef");
  const amountSessionsInput = document.getElementById("createRestaurant-amountSessions");
  const adultPriceInput = document.getElementById("createRestaurant-adultPrice");
  const childPriceInput = document.getElementById("createRestaurant-childPrice");

  if (nameInput.value.trim() === "") {
    alert("Please enter a valid restaurant name.");
    nameInput.focus();
    return false;
  }

  if (addressInput.value.trim() === "") {
    alert("Please enter a valid restaurant address.");
    addressInput.focus();
    return false;
  }

  if (contactInput.value.trim() === "") {
    alert("Please enter a valid restaurant contact.");
    contactInput.focus();
    return false;
  }

  if (cardDescriptionInput.value.trim() === "") {
    alert("Please enter a valid restaurant card description.");
    cardDescriptionInput.focus();
    return false;
  }

  if (descriptionInput.value.trim() === "") {
    alert("Please enter a valid restaurant description.");
    descriptionInput.focus();
    return false;
  }

  if (amountOfStarsInput.value.trim() === "" || isNaN(amountOfStarsInput.value.trim())) {
    alert("Please enter a valid number for the amount of stars.");
    amountOfStarsInput.focus();
    return false;
  }

  if (bannerImageInput.value.trim() === "") {
    alert("Please enter a valid banner or image URL.");
    bannerImageInput.focus();
    return false;
  }

  if (headChefInput.value.trim() === "") {
    alert("Please enter a valid head chef name.");
    headChefInput.focus();
    return false;
  }

  if (amountSessionsInput.value.trim() === "" || isNaN(amountSessionsInput.value.trim())) {
    alert("Please enter a valid number for the amount of sessions.");
    amountSessionsInput.focus();
    return false;
  }

  if (adultPriceInput.value.trim() === "" || isNaN(adultPriceInput.value.trim())) {
    alert("Please enter a valid price for adults.");
    adultPriceInput.focus();
    return false;
  }

  if (childPriceInput.value.trim() === "" || isNaN(childPriceInput.value.trim())) {
    alert("Please enter a valid price for children.");
    childPriceInput.focus();
    return false;
  }

  return true;
}
// ----------------- EINDE ADDRESTAURANT CHECKEN ------------------

// ----------------- HIER DE EDITRESERVATION CHECKEN ------------------
function checkEditReservationForm(ticketID) {
  // Get form input elements
  const timeSlotID = document.getElementById(`editReservationTimeSlotID-${ticketID}`);
  const restaurantID = document.getElementById(`editReservationRestaurantID-${ticketID}`);
  const reservationName = document.getElementById(`editReservationName-${ticketID}`);
  const phoneNumber = document.getElementById(`editReservationPhoneNumber-${ticketID}`);
  const numberAdults = document.getElementById(`editReservationNumberAdults-${ticketID}`);
  const numberChildren = document.getElementById(`editReservationNumberChildren-${ticketID}`);
  const remark = document.getElementById(`editReservationRemark-${ticketID}`);

  // Validate input
  if (timeSlotID.value.trim() === "") {
    alert("Please enter a valid time slot ID.");
    timeSlotID.focus();
    return false;
  }
  if (restaurantID.value.trim() === "") {
    alert("Please enter a valid restaurant ID.");
    restaurantID.focus();
    return false;
  }
  if (reservationName.value.trim() === "") {
    alert("Please enter a valid reservation name.");
    reservationName.focus();
    return false;
  }
  if (phoneNumber.value.trim() === "" || !checkPhoneNumber(phoneNumber.value.trim())) {
    alert("Please enter a valid phone number.");
    phoneNumber.focus();
    return false;
  }
  if (numberAdults.value.trim() === "" || isNaN(numberAdults.value.trim()) || numberAdults.value.trim() < 1 || numberAdults.value.trim() > 20) {
    alert("Please enter a valid number of adults (1-20).");
    numberAdults.focus();
    return false;
  }
  if (numberChildren.value.trim() !== "" && (isNaN(numberChildren.value.trim()) || numberChildren.value.trim() < 0 || numberChildren.value.trim() > 20)) {
    alert("Please enter a valid number of children (0-20).");
    numberChildren.focus();
    return false;
  }
  if (remark.value.trim() !== "" && remark.value.trim().length > 200) {
    alert("Please enter a valid remark (maximum 200 characters).");
    remark.focus();
    return false;
  }
   // Input is valid, submit form
   submitForm(() => closeModal());
   return true;
}

function checkPhoneNumber(phoneNr) {
  const regex = /^((\+31|0)6[-\s]?[1-9](\d[-\s]?){7})$/;
  return regex.test(phoneNr);
}
// ----------------- EINDE EDITRESERVATION CHECKEN ------------------

// ----------------- HIER DE ADDRESERVATION CHECKEN ------------------
function checkAddReservationForm() {
     // Get form input elements
     const timeSlotID = document.getElementById("createReservationTimeSlotID");
     const restaurantID = document.getElementById("createReservationRestaurantID");
     const reservationName = document.getElementById("createReservationName");
     const phoneNumber = document.getElementById("createReservationPhoneNumber");
     const numberAdults = document.getElementById("createReservationNumberAdults");
     const numberChildren = document.getElementById("createReservationNumberChildren");
     const remark = document.getElementById("createReservationRemark");
 
     // Validate input
     if (timeSlotID.value.trim() === "") {
         alert("Please enter a valid TimeSlotID.");
         timeSlotID.focus();
         return false;
     }
     if (restaurantID.value.trim() === "") {
         alert("Please enter a valid RestaurantID.");
         restaurantID.focus();
         return false;
     }
     if (reservationName.value.trim() === "") {
         alert("Please enter a valid ReservationName.");
         reservationName.focus();
         return false;
     }
     if (phoneNumber.value.trim() === "" || !checkPhoneNumber(phoneNumber.value.trim())) {
         alert("Please enter a valid phone number.");
         phoneNumber.focus();
         return false;
     }
     if (numberAdults.value.trim() === "" || isNaN(numberAdults.value.trim()) || numberAdults.value.trim() < 1 || numberAdults.value.trim() > 20) {
         alert("Please enter a valid number of adults (1-20).");
         numberAdults.focus();
         return false;
     }
     if (numberChildren.value.trim() !== "" && (isNaN(numberChildren.value.trim()) || numberChildren.value.trim() < 0 || numberChildren.value.trim() > 20)) {
         alert("Please enter a valid number of children (0-20).");
         numberChildren.focus();
         return false;
     }
     if (remark.value.trim() !== "" && remark.value.trim().length > 200) {
         alert("Please enter a valid remark (maximum 200 characters).");
         remark.focus();
         return false;
     }
 
     // Input is valid, submit form
     return true;
 }
// ----------------- EINDE ADDRESERVATION CHECKEN ------------------