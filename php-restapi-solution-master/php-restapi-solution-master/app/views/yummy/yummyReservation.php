<!-- <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

    <title>The Festival</title>
</head> -->

<body>

    <link href="../css/reservation.css" rel="stylesheet">

    <!-- HIER LOOP VOOR EVENT ID EN ACTIVITY ID -->

    <div class="overlay-container">
        <div class="overlay">
            <div class="container" id="overlay">
                <form id="form" method="POST">

                    <?php $arrayselector = 0 ?>
                    <?php $numberButtons = 1; ?>

                    <div class="row text-center">
                        HIER LOOP VOOR EVENT ID EN ACTIVITY ID
                        <h1>Make a reservation for:
                            <?= $restaurant[0]->getRestaurantName() ?>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Select your arrival date and time</h3>
                        </div>
                        <div class="col-md-6">
                            <h3>Your reservation details</h3>
                        </div>
                    </div>
                    <div class="row">
                        <!-- buttons thursday and friday -- for form use btnradio -->
                        <div class="col-md-3">
                            <h4><ins>Thursday 26 July</ins></h4>
                            <?php
                            $i = 1;
                            for ($j = 0; $j < 3; $j++) {
                                $maxSeats = $timeSlotsYummy[$arrayselector]->getMaximumAmountTickets();
                            ?>
                                <!-- Display the session date and time with the session number -->
                                <label class="btn btn-outline-primary w-100">
                                    <input type="radio" class="btn-check" name="btnradio" value="<?= $timeSlotsYummy[$arrayselector]->getTimeSlotID() ?>" data-max-tickets="<?= $maxSeats ?>">
                                    <?= "<b>Session $i: " . $timeSlotsYummy[$arrayselector]->getStartTime()->format('H:i') . "</b>" ?>
                                </label><br>
                            <?php
                                $numberButtons++;
                                $arrayselector++;
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="col-md-3">
                            <h4><ins>Friday 27 July</ins></h4>
                            <?php
                            $i = 1;
                            for ($j = 0; $j < 3; $j++) {
                                $maxSeats = $timeSlotsYummy[$arrayselector]->getMaximumAmountTickets();
                            ?>
                                <!-- Display the session date and time with the session number -->
                                <label class="btn btn-outline-primary w-100">
                                    <input type="radio" class="btn-check" name="btnradio" value="<?= $timeSlotsYummy[$arrayselector]->getTimeSlotID() ?>" data-max-tickets="<?= $maxSeats ?>">
                                    <?= "<b>Session $i: " . $timeSlotsYummy[$arrayselector]->getStartTime()->format('H:i') . "</b>" ?>
                                </label><br>
                            <?php
                                $numberButtons++;
                                $arrayselector++;
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <!-- id = customerName -->
                            <label for="customerName">
                                <h4>Name on reservation</h4>
                            </label>
                            <input class="form-control" id="customerName" name="customerName" type="text" placeholder="Enter name" required>
                        </div>
                        <div class="col-md-2">
                            <!-- id = phoneNr -->
                            <label for="phoneNr">
                                <h4>Phone number</h4>
                            </label>
                            <input class="form-control" id="phoneNr" name="phoneNr" type="tel" placeholder="00 123456789" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <h3>Available seats</h3>
                        </div>
                        <div class="col-md-3">
                            <h3>Group size</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <h4><ins>Saturday 28 July</ins></h4>
                            <?php
                            $i = 1;
                            for ($j = 0; $j < 3; $j++) {
                                $maxSeats = $timeSlotsYummy[$arrayselector]->getMaximumAmountTickets();
                            ?>
                                <!-- Display the session date and time with the session number -->
                                <label class="btn btn-outline-primary w-100">
                                    <input type="radio" class="btn-check" name="btnradio" value="<?= $timeSlotsYummy[$arrayselector]->getTimeSlotID() ?>" data-max-tickets="<?= $maxSeats ?>">
                                    <?= "<b>Session $i: " . $timeSlotsYummy[$arrayselector]->getStartTime()->format('H:i') . "</b>" ?>
                                </label><br>
                            <?php
                                $numberButtons++;
                                $arrayselector++;
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="col-md-3">
                            <h4><ins>Sunday 29 July</ins></h4>
                            <?php
                            $i = 1;
                            for ($j = 0; $j < 3; $j++) {
                                $maxSeats = $timeSlotsYummy[$arrayselector]->getMaximumAmountTickets();
                            ?>
                                <!-- Display the session date and time with the session number -->
                                <label class="btn btn-outline-primary w-100">
                                    <input type="radio" class="btn-check" name="btnradio" value="<?= $timeSlotsYummy[$arrayselector]->getTimeSlotID() ?>" data-max-tickets="<?= $maxSeats ?>">
                                    <?= "<b>Session $i: " . $timeSlotsYummy[$arrayselector]->getStartTime()->format('H:i') . "</b>" ?>
                                </label><br>
                            <?php
                                $numberButtons++;
                                $arrayselector++;
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="col-3">
                            <p class="fs-3"><strong><span id="seats">No timeslot selected</span></strong></p>
                        </div>
                        <div class="col-3">
                            <h4>Number of adults</h4>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary Aminus-btn" type="button">-</button>
                                </div>
                                <input type="number" id="nrAdult" name="nrAdult" value="1" min="1" max="20">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary Aplus-btn" type="button">+</button>
                                </div>
                            </div>
                            <h4>Number of children (-12)</h4>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary Cminus-btn" type="button">-</button>
                                </div>
                                <input type="number" id="nrChild" name="nrChild" value="0" min="0" max="20">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary Cplus-btn" type="button">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <br><br>
                            <h4>Any special requests or allergies? Enter them below.</h4>
                        </div>
                        <div class="col-md-6">
                            <br><br>
                            <h4>Details</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border" id="overview">
                                <p>Number of adults: <span id="adults">1</span></p>
                                <p>Number Children: <span id="children">0</span></p>
                                <p>Reservation fee* (<span id="group">1</span>): €<span id="price">10.00</span></p>
                                <hr>
                                <p>Total price: €<span id="total-price">10.00</span></p>
                            </div>
                            <p>*A reservation fee of €10,- pp. will be administerred.<br>
                                This fee will be deducted from the final check on visiting the restaurant.
                            </p>
                            <button class="btn btn-primary" type="submit" for="form">Continue</button>
                            <button type="button" onclick="hideOverlay();" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/yummy/restaurant.js"></script>
</body>