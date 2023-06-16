var urlParams = new URLSearchParams(window.location.search);
var encodedCartData = urlParams.get('cart');
if (encodedCartData) {
    var cartDataString = atob(encodedCartData);
    var cartData = JSON.parse(cartDataString);
    sessionStorage.setItem('personalProgram', cartData);
    updateCartItemDisplay();
    urlParams.delete('cart');
    var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    if (urlParams.toString()) {
        newUrl += '?' + urlParams.toString();
    }
    history.replaceState({}, '', newUrl);

}