try {
    var personalProgram = JSON.parse(sessionStorage.getItem('personalProgram')) || [];
    updateCartItemDisplay();
} catch {
    console.error("Loading the personal program failed. Data might be lost.");
    var personalProgram = [];
}
function addToPersonalProgram(timeSlotID, quantity) {
    quantity = Math.max(quantity, 1);

    const existingTicket = personalProgram.find(item => item.id === timeSlotID);
    console.log(timeSlotID);
    if (isNaN(quantity) || quantity <= 0) {
        console.error("Something went wrong while adding to the personal program. Please check if the quantity is correct.");
    } else if(isNaN(timeSlotID) || timeSlotID <= null){
        console.error("Something went wrong while adding to the personal program. Please check if the timeslot is correct")
    } 
    else {
        if (quantity > 20) {
            quantity = 20;
        }
        if (existingTicket) {
            existingTicket.quantity += quantity;
        } else {
            personalProgram.push({
                id: timeSlotID,
                quantity: quantity
            });
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