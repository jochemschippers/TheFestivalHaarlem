<?php
// Create an array of test data for tickets
$tickets = array(
  array(
    "id" => 1234,
    "date" => "2023-03-15",
    "name" => "John Smith",
    "price" => 50,
    "amount" => 2
  ),
  array(
    "id" => 2345,
    "date" => "2023-03-16",
    "name" => "Jane Doe",
    "price" => 40,
    "amount" => 1
  ),
  // Add more tickets as you wish
);

// Initialize a variable to store the grand total
$grand_total = 0;
?>
<body>
  <img id="background" src="\image\Payment\overview\backgroundpayment.png">


  <div class="container" id="progressContainer">
    <div class="card">
      <div class="row d-flex justify-content-between px-3 top">
        <div class="d-flex">
        </div>
        <div class="d-flex flex-column text-sm-right">
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-12">
          <ul id="progressbar" class="text-center">
            <li class="active step0">
              <i class="fa fa-magnifying-glass-dollar fa-3x"></i>
              <p>Review tickets</p>
            </li>
            <li class="active step0">
              <i class="fa fa-sign-in-alt fa-3x"></i>
              <p>Login</p>
            </li>
            <li class=" active step0">
              <i class="fa fa-credit-card fa-3x"></i>
              <p>Payment information</p>
            </li>
            <li class="step0">
              <i class="fa fa-ticket-alt fa-3x"></i>
              <p>Receive tickets</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="payContainer">
    <div class="container" id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
    <script>
      function initPayPalButton() {
        paypal.Buttons({
          style: {
            shape: 'rect',
            color: 'gold',
            layout: 'vertical',
            label: 'paypal',
          },

          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                "amount": {
                  "currency_code": "USD",
                  "value": 1
                }
              }]
            });
          },

          onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {

              // Full available details
              console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

              // Show a success message within this page, e.g.
              const element = document.getElementById('paypal-button-container');
              element.innerHTML = '';
              element.innerHTML = '<h3>Thank you for your payment!</h3>';

              // Or go to another URL:  actions.redirect('thank_you.html');

            });
          },

          onError: function(err) {
            console.log(err);
          }
        }).render('#paypal-button-container');
      }
      initPayPalButton();
    </script>

    <div class="container" id="priceTable">
      <!-- Create a table with Bootstrap classes -->
      <table class="table" id="tablePrice">
        <!-- Create table header -->
        <thead class="thead">
          <tr>
            <th>ID</th>
            <th>Total Price</th>
          </tr>
        </thead>
        <!-- Create table body -->
        <tbody>


          <?php foreach ($tickets as $ticket) { ?>
            <!-- Loop through each ticket and calculate its total price -->
            <?php $total_price = $ticket["price"] * $ticket["amount"]; ?>
            <!-- Add the total price to the grand total -->
            <?php $grand_total += $total_price; ?>
            <!-- Display the ticket ID and its total price in a row -->
            <tr>
              <td>
                <?php echo $ticket["id"]; ?>
              </td>
              <td>$
                <?php echo number_format($total_price, 2); ?>
              </td>
            </tr>
          <?php } ?>
          <!-- Display a row for the grand total -->
          <tr>
            <th>Total</th>
            <th>$
              <?php echo number_format($grand_total, 2); ?>
            </th>
          </tr>
          <tr>
            <td colspan="2spa">
              <a href="/paymentpage/recieve" class="btn btn-primary" id="continueButton">Continue</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>