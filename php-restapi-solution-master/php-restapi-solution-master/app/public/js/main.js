try {
    var personalProgram = JSON.parse(sessionStorage.getItem('personalProgram')) || [];
    updateCartItemDisplay();
    console.log(sessionStorage.getItem('personalProgram') );

} catch {
    console.error("Loading the personal program failed. Data might be lost.");
    var personalProgram = [];
    sessionStorage.setItem('personalProgram', JSON.stringify(personalProgram));
    
}
function addToPersonalProgram(timeSlotID, quantity, reservation = null) {
    quantity = Math.max(quantity, 1);
    personalProgram = JSON.parse(sessionStorage.getItem('personalProgram')) || [];

    const existingTicket = personalProgram.find(ticket => ticket.id === timeSlotID);

    if (isNaN(quantity) || quantity <= 0) {
        console.error("Something went wrong while adding to the personal program. Please check if the quantity is correct.");
    } else if(isNaN(timeSlotID) || timeSlotID <= null){
        console.error("Something went wrong while adding to the personal program. Please check if the timeslot is correct")
    } else {
        if (existingTicket && reservation == null) {
            existingTicket.quantity += quantity;
            // Update the reservation data if provided.
            if (reservation) {
                existingTicket.reservation = reservation;
            }
        } else {
            const newProgramItem = {
                id: timeSlotID,
                quantity: quantity
            };
            // Add the reservation data if provided.
            if (reservation) {
                newProgramItem.reservation = reservation;
            }
            personalProgram.push(newProgramItem);
        }
        sessionStorage.setItem('personalProgram', JSON.stringify(personalProgram));
        updateCartItemDisplay();
    }
}
function updateCartItemDisplay() {
    const cartItemCount = document.querySelector(".cart-item-count");
    const totalCount = personalProgram.reduce((acc, item) => acc + item.quantity, 0);
  
    if (totalCount > 0) {
      cartItemCount.textContent = totalCount;
      cartItemCount.classList.add("cart-item-count-active");
    } else {
      cartItemCount.textContent = "";
      cartItemCount.classList.remove("cart-item-count-active");
    }
  }
  function getQuantityByID(id) {
    try {
        let personalProgram = JSON.parse(sessionStorage.getItem('personalProgram')) || [];
        let ticket = personalProgram.find(item => item.id === id);
        return ticket ? ticket.quantity : 0;
    } catch {
        //Failed to get quantity by ID. The personal program might not exist
        return 0;
    }
}
function removeFromPersonalProgram(timeSlotID) {
    personalProgram = personalProgram.filter(item => item.id !== timeSlotID);
    sessionStorage.setItem('personalProgram', JSON.stringify(personalProgram));
    updateCartItemDisplay();
}