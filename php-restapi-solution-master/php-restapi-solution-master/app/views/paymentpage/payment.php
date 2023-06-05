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
              <a href="/paymentpage">
                <i class="fa fa-magnifying-glass-dollar fa-3x"></i>
                <p>Review tickets</p>
              </a>
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
      <div class="alert alert-success alert-dismissible d-none" role="alert">
        <button type="button" class="btn-close" aria-label="Close"></button>
        <p><i class="bi bi-check-circle-fill"></i> ...</p>
    </div>

    <div class="alert alert-warning alert-dismissible d-none" role="alert">
        <button type="button" class="btn-close" aria-label="Close"></button>
        <p><i class="bi bi-exclamation-triangle-fill"></i> ...</p>
    </div>
    </div>
  </div>
  <div id="payContainer">
  <?php
?>
  </div>
</body>