console.log("IK WORD GELEZEN");

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})

// onclick="editRestaurantModal(<?= $restaurant->getRestaurantID() ?>)"

// function editRestaurantModal($restaurantId) {
//     console.log($restaurantId);

//     const myModal = document.getElementById("staticBackdrop-" + $restaurantId);

//     console.log(myModal);

//     const myInput = document.getElementById('editRestaurantButton');

//     myModal.addEventListener('shown.bs.modal', () => {
//         myInput.focus();
//     });
// }