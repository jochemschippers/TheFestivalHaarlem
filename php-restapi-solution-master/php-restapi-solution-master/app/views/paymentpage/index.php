<!DOCTYPE html>
<html>
  <head>
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
      .basket-list {
        border: 1px solid #ccc;
        padding: 10px;
      }
      .basket-item {
        margin-bottom: 10px;
      }
      .basket-item-name {
        font-weight: bold;
      }
      .basket-item-price {
        font-style: italic;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h1>Payment Page</h1>
          <form>
            <div class="form-group">
              <label for="card-holder-name">Card Holder Name</label>
              <input type="text" class="form-control" id="card-holder-name" placeholder="Enter card holder name">
            </div>
            <div class="form-group">
              <label for="card-number">Card Number</label>
              <input type="text" class="form-control" id="card-number" placeholder="Enter card number">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="expiration-month">Expiration Month</label>
                <input type="text" class="form-control" id="expiration-month" placeholder="MM">
              </div>
              <div class="form-group col-md-6">
                <label for="expiration-year">Expiration Year</label>
                <input type="text" class="form-control" id="expiration-year" placeholder="YYYY">
              </div>
            </div>
            <div class="form-group">
              <label for="cvv">CVV</label>
              <input type="text" class="form-control" id="cvv" placeholder="Enter CVV">
            </div>
            <div class="form-group">
              <label for="billing-address">Billing Address</label>
              <input type="text" class="form-control" id="billing-address" placeholder="Enter billing address">
            </div>
            <div class="form-group">
              <label>Payment Method</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment-method" id="credit-card" value="credit-card" checked>
                <label class="form-check-label" for="credit-card">Credit Card</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment-method" id="debit-card" value="debit-card">
                <label class="form-check-label" for="debit-card">Debit Card</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment-method" id="paypal" value="paypal">
                <label class="form-check-label" for="paypal">PayPal</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="payment-method" id="ideal" value="ideal">
                <label class="form-check-label" for="ideal">Ideal</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Pay Now</button>
          </form>
        </div>
        <div class="col-md-4">
          <div class="basket-list">
            <h3>Basket</h3>
            <div class="basket-item">
              <div class="basket-item-name">Item 1</div>
              <div class="basket-item-price">$10.00</div>
            </div>
            <div class="basket-item">
              <div class="basket-item-name">Item 2</div>
              <div class="basket-item-price">$20.00</div>
            </div>
            <div class="basket-item">
              <div class="basket-item-name">Item 3</div>
              <div class="basket-item-price">$30.00</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
