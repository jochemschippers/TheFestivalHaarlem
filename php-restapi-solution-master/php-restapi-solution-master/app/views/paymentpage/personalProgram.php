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
    <div class="row w-90 m-5">
        <div class="col-6 d-flex flex-column">
            <h2 class="mt-auto mb-1">Thank you for finishing your personal program <br> We hope you will enjoy
                and have fun at the Festival</h2>
            <p class="mt-1 mb-auto">
                Your personal program ID is ‘000000<?= $personalProgram->getProgramID() ?>’ <br>
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
</body>

</html>