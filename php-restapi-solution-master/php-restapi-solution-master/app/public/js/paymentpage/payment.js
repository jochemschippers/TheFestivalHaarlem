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
  if(data.error){
    showError();
    showWarning(data.error);
  }
  else{
    window.location.href = data.paymentUrl;
  }
})
.catch(error => {
  showError();
    showWarning('Error while loading the personal program. Please try again later.' + error);
  });

function showError(){
  const loading = document.getElementById('loading');
  loading.innerHTML = `<i class="fa fa-times fa-3x text-danger"></i><h1>Error</h1>`;
}
