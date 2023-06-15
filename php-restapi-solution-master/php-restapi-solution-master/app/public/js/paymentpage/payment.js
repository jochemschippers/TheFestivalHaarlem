const cart = JSON.parse(sessionStorage.getItem('personalProgram') || '[]' === [])

if(cart === []){
  window.location.href = '/paymentpage';
}
fetch('createMolliePayment', {
  method: 'POST',
  headers: {
      'Content-Type': 'application/json'
  },
  body: JSON.stringify({
      cart: cart,
  })
})
.then(response => response.json())
.then(data => {
  window.location.href = data.paymentUrl;
})
.catch(error => {
    showWarning('Error while loading the personal program. Please try again later.' + error);
  });
