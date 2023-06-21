<body>
  <div id="logo" class="d-flex justify-content-center align-items-center"><img id="background" class="" src="\image\Payment\overview\backgroundpayment.png"></div>


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
    <div id="loading" class="loading d-flex justify-content-center align-items-center w-100">
      <h1> redirecting to payment page...</h1>
      <div class="loader loader--style2 " title="1">
        <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="200px" height="200px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
          <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
            <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite" />
          </path>
        </svg>
      </div>
    </div>
  </div>
</body>