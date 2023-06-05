fetch('/paymentpage/getPersonalProgramItems', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        cart: JSON.parse(sessionStorage.getItem('personalProgram') || '[]'),
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data['status'] == 2) {
        const timeslots = data['tickets'];
        calculateTotals(timeslots)["total"];
    }
  })
  .catch(error => {
    showWarning('Error while loading the personal program. Please try again later.' + error);
  });

  function initiateMolliePayment(total) {
    // Create a new payment
    fetch('/create_payment', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8'  // Mollie API Key
      },
      body: JSON.stringify({
        amount: {
          currency: 'EUR',  // Replace with your currency
          value: total.toFixed(2) // Send the amount as a string, formatted to two decimal places
        },
        description: 'Your Order Description',
        redirectUrl: `${window.location.origin}/payment/completed`, // Redirect user here after payment
        webhookUrl: `${window.location.origin}/webhook/payment`, // Mollie will send status updates here
      }),
    })
    .then(response => response.json())
    .then(payment => {
      // Redirect the user to complete the payment
      window.location.href = payment._links.checkout.href;
    })
    .catch(error => {
      console.error('Error:', error);
    });
  }