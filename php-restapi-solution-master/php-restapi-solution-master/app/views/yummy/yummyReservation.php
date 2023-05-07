<body>
    <!-- HIER LOOP VOOR EVENT ID EN ACTIVITY ID -->

    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form onsubmit="return checkForm()" id="form" method="POST">

                        <?php $arrayselector = 0 ?>
                        <?php $numberButtons = 1; ?>

                        <div class="row text-center">
                            <h2>Make a reservation for:
                                <?= $restaurant[0]->getRestaurantName() ?>
                            </h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Select your arrival date and time</h4>
                            </div>
                            <div class="col-md-6">
                                <h4>Your reservation details</h4>
                            </div>
                        </div>
                        <div class="row">
                            <!-- buttons thursday and friday -- for form use btnradio -->
                            <div class="col-md-3">
                                <h5><ins>Thursday 26 July</ins></h5>
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
                                <h5><ins>Friday 27 July</ins></h5>
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
                                    <h5>Name on reservation</h5>
                                </label>
                                <input class="form-control" id="customerName" name="customerName" type="text" placeholder="Enter name" required>
                            </div>
                            <div class="col-md-2">
                                <!-- id = phoneNr -->
                                <label for="phoneNr">
                                    <h5>Phone number</h5>
                                </label>
                                <input class="form-control" id="phoneNr" name="phoneNr" type="tel" placeholder="00 123456789" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-3">
                                <h4>Available seats</h4>
                            </div>
                            <div class="col-md-3">
                                <h4>Group size</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h5><ins>Saturday 28 July</ins></h5>
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
                                <h5><ins>Sunday 29 July</ins></h5>
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
                                <h5>Number of adults</h5>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary Aminus-btn" type="button">-</button>
                                    </div>
                                    <input type="number" id="nrAdult" name="nrAdult" value="1" min="1" max="20">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary Aplus-btn" type="button">+</button>
                                    </div>
                                </div>
                                <h5>Number of children (-12)</h5>
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
                                <h5>Any special requests or allergies? Enter them below.</h5>
                            </div>
                            <div class="col-md-6">
                                <br><br>
                                <h5>Details</h5>
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
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/yummy/restaurant.js"></script>