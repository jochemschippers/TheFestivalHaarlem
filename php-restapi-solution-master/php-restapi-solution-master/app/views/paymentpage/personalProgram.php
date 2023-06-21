<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tickets</title>
</head>

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
                        <li class="active step0">
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
    <div class="row m-5">
        <div class="col-6 d-flex flex-column">
            <h2 class="mt-auto mb-1">Thank you for finishing your personal program <br> We hope you will enjoy
                and have fun at the Festival</h2>
            <p class="mt-1 mb-auto">
                Your personal program ID is ‘HAFES<?= $personalProgram->getProgramID() ?>’ <br>
                The personal program has been sent to your email address, along with all the necessary information for a great day in Haarlem. <br>
                For questions, changes or support mail ‘thefestival@haarlem.com
            </p>
        </div>
        <div class="col-6 d-flex flex-column">
            <h2 class="mt-auto mb-1">Your personal program</h2>
            <table class="mb-auto w-100 table">
                <thead>
                    <tr style="border-bottom: 2px solid #961B1B;">
                        <th>Event</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Amount</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($personalProgram->getItems() as $item) : ?>
                        <tr>
                            <td><?= $item->getTitle() ?></td>
                            <td>
                                <?php
                                $startDate = $item->getStartTime()->format('Y-m-d');
                                $endDate = $item->getEndTime()->format('Y-m-d');
                                ?>
                                <?= $startDate !== $endDate ? "$startDate - $endDate" : $startDate ?>
                            </td>
                            <td>
                                <?php
                                $startDate = $item->getStartTime()->format('Y-m-d');
                                $endDate = $item->getEndTime()->format('Y-m-d');
                                ?>
                                <?= $startDate !== $endDate ? 'multiple' : $item->getStartTime()->format('H:i') . ' - ' . $item->getEndTime()->format('H:i') ?>
                            </td>
                            <td><?= $item->getQuantity() . 'x' ?></td>
                            <td><?= number_format($item->getPrice() * $item->getQuantity(), 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>VAT</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?= $personalProgram->getTotals()['vat'] ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: left;">Total:</td>
                        <td><?= $personalProgram->getTotals()['total'] ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <svg version="1.1" id="loader" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="200px" height="200px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
        <path fill="#000" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z">
            <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite" />
        </path>
    </svg>
    <div class="row">
        <img class="image rounded-5 w-auto" id='qr-code' src=""></img>
    </div>
</body>

</html>