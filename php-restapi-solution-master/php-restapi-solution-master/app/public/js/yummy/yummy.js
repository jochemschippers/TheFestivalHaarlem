function getRandomRestaurantId(restaurantIDs) {
    var randomRestaurantId = restaurantIDs[Math.floor(Math.random() * restaurantIDs.length)];
    console.log('Random Restaurant ID:', randomRestaurantId);
    window.location.href = '/yummy/restaurant?restaurantId=' + randomRestaurantId;
}
function getRestaurantId(restaurantId) {
    console.log('Restaurant ID:', restaurantId);
    window.location.href = '/yummy/restaurant?restaurantId=' + restaurantId;
}
filterSelection("all")
function filterSelection(c) {
    var x, i;
    x = document.getElementsByClassName("filterDiv");
    if (c == "all") c = "";
    for (i = 0; i < x.length; i++) {
        RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
    }
}
// Show filtered elements
function AddClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
            element.className += " " + arr2[i];
        }
    }
}
// Hide elements that are not selected
function RemoveClass(element, name) {
    var i, arr1, arr2;
    arr1 = element.className.split(" ");
    arr2 = name.split(" ");
    for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
            arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
    }
    element.className = arr1.join(" ");
}
var foodTypesList = " . json_encode($foodTypesList) . ";