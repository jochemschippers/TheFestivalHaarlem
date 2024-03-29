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
                            <i class="fa fa-magnifying-glass-dollar fa-3x"></i>
                            <p>Review tickets</p>
                        </li>
                        <li class="step0">
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
    <div class="alert alert-success alert-dismissible d-none" role="alert">
        <button type="button" class="btn-close" aria-label="Close"></button>
        <p><i class="bi bi-check-circle-fill"></i> ...</p>
    </div>

    <div class="alert alert-warning alert-dismissible d-none" role="alert">
        <button type="button" class="btn-close" aria-label="Close"></button>
        <p><i class="bi bi-exclamation-triangle-fill"></i> ...</p>
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Personal Program</h1>
    </div>
    <div class="container mb-5" id="container">
        <div class="row" id="Jazz">
            <div class="col-md-6 tables">
                <div class="table-header w-100 text-center p-2">Jazz</div>
                <table class="table" id="tableJazz">
                    <tbody>
                    </tbody>
                </table>
                <div class="table-header w-100 text-center p-2">Yummy</div>
                <table class="table" id="tableYummy">
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table" id="tablePrice">
                    <thead class="thead">
                        <tr>
                            <th>ID</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody id="priceTableBody">
                    </tbody>
                </table>
                <?php
                $buttonText = 'Continue';
                $buttonClass = 'btn continue-btn';
                $buttonHref = '/paymentpage/payment';

                if (!isset($_SESSION['userID'])) {
                    $buttonText = 'Please login to continue';
                    $buttonClass = 'btn-secondary';
                    $buttonHref = 'javascript:void(0)';
                }
                ?>
                <a href="<?= $buttonHref; ?>" class="btn <?= $buttonClass; ?>" id="continueButton"><?php echo $buttonText; ?></a>
            </div>
            <button id="share-btn" class="btn continue-btn mt-3 ml-0">Share Personal Program</button>
            <div id="share-container" class="d-flex justify-content-left align-items-center p-0" style="display: none !important;">
                <input type="text" id="share-link" class="me-3" readonly>
                <button id="copy-btn" class="btn btn-secondary">Copy to Clipboard</button>
            </div>
        </div>
    </div>