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
            <div class="col-md-6">
                <table class="table" id="tableJazz">
                    <thead class="thead">
                        <tr>
                            <th>Jazz</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <table class="table" id="tableYummy">
                    <thead class="thead">
                        <tr>
                            <th>Yummy</th>
                        </tr>
                    </thead>
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
        </div>
        <button id="share-btn" class="btn btn-primary">Share Personal Program</button>
        <div id="share-container" style="display: none;">
            <input type="text" id="share-link" readonly>
            <button id="copy-btn" class="btn btn-secondary">Copy to Clipboard</button>
        </div>
    </div>