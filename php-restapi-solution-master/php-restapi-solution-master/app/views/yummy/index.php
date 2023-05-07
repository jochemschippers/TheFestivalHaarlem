<body>
    <div class="background-Image">
        <div class="border-box">
            <div class="container" id="titleContainer">
                <h1>Yummy</h1>
            </div>
        </div>

        <div class="container landingPageContainer">
            <div class="row">
                <div class="col-md-7" id="titleText">
                    <h2>Experience <strong>food</strong> at its best </h2>
                    <p>You say food, we say Yummy! One of the most anticipated and well-known food festival in North
                        Holland,
                        specialising in showing its visitors all the best the beautiful city of Haarlem has to offer.
                        Get ready to get a taste of heaven.
                        <br> <br>
                        Below you can choose between the participating restaurants.
                    </p>
                </div>
            </div>
            <div class="row">
                <?php foreach ($restaurants as $restaurant) {
                    $restaurantIDs[] = $restaurant->getRestaurantId();
                } ?>
                <a class="btn btn-primary col-6" onclick="getRandomRestaurantId(<?php echo json_encode($restaurantIDs); ?>)">
                    Surprise me!
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" id="titleText"> <!-- PAS AAN NAAR EVENT PAGE OF DETAIL PAGE (AANTAL columns) -->
            </div>
            <div class="col-md-4">
            </div>
            <div class="row text-center">
                <h1>Participating Restaurants</h1>
            </div>

            <!-- DIT STUK GAAT ZO WEG -->

            <div class="row">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <?php
                    $foodTypeNames = []; // initialize an empty array to store the foodTypeIds
                    $i = 0; // initialize $i outside the loop
                    foreach ($foodTypes as $type) {
                        $foodTypeName = $type->getFoodTypeName(); // get the foodTypeId for the current type
                        if (in_array($foodTypeName, $foodTypeNames)) {
                            // foodTypeId is already in the list, do nothing
                        } else {
                            // foodTypeId is not in the list, add it
                            array_push($foodTypeNames, $foodTypeName); // add the foodTypeId to the array
                            // display the label and input element for this type
                    ?>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio<?= $i ?>" onclick="filterSelection('<?= strtolower($type->getFoodTypeName()) ?> ')">
                            <label class="btn btn-outline-primary" for="btnradio<?= $i ?>"><?= $type->getFoodTypeName() ?></label>
                    <?php
                            $i++; // increment $i after displaying the label and input element
                        }
                    }
                    ?>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" onclick="filterSelection('all')" checked>
                    <label class="btn btn-outline-primary" for="btnradio6">Clear selected</label>
                </div>
            </div>

            <div class="border-box" id="restaurantBorder">
                <div class="row filter-items">
                    <?php
                    foreach ($restaurants as $restaurant) {
                        $restaurantId = $restaurant->getRestaurantId();
                        $foodTypeNames = '';
                        foreach ($restaurantFoodTypes as $foodType) {
                            if ($foodType->getRestaurantID() == $restaurant->getRestaurantID()) {
                                $foodTypeNames .= $foodType->getFoodTypeName() . ' ';
                            }
                        }
                    ?>
                        <div class="filterDiv  <?= strtolower(trim($foodTypeNames)) ?> col-md-2 ">
                            <div class="card" id="card">
                                <img src="/image/<?= $restaurant->getBannerImage() ?>" class="card-img-top" alt="Logo" id="cardLogo">
                                <div class="card-body d-flex flex-column" id="cardBody">
                                    <h5 class="card-title"><i>
                                            <?= $restaurant->getRestaurantName() ?>
                                        </i></h5>
                                    <h6 class="card-sub-title"><i>
                                            <?= str_replace(',', ',<br>', $restaurant->getAddress()) ?>
                                        </i></h6>
                                    <p class="card-text"><i>
                                            <?= $restaurant->getCardDescription() ?>
                                        </i></p>

                                    <a class="btn btn-primary mt-auto" onclick="getRestaurantId(<?= $restaurant->getRestaurantId(); ?>)">Menu and
                                        info</a>
                                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal-<?= $restaurant->getRestaurantId() ?>">Make your reservation</a>
                                </div>
                            </div>
                        </div>
                        <!-- start of modal -->
                        <div class="modal fade" id="reservationModal-<?= $restaurant->getRestaurantId() ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog custom-modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">

                                        <?php
                                        $timeSlotsYummy = array();
                                        foreach ($allTimeSlotsYummy as $timeSlot) {
                                            if ($timeSlot->getRestaurantID() == $restaurant->getRestaurantId()) {
                                                $timeSlotsYummy[] = $timeSlot;
                                            }
                                        }
                                        ?>
                                        <form id="form" method="POST" onsubmit="return checkForm()">

                                            <?php $arrayselector = 0 ?>
                                            <?php $numberButtons = 1; ?>

                                            <div class="row text-center">
                                                <h2>Make a reservation for:
                                                    <?= $restaurant->getRestaurantName() ?>
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
                                                        <button class="btn btn-outline-secondary Aminus-btn minusButton" type="button">-</button>
                                                        <input class="aInputNumber" type="number" id="nrAdult" name="nrAdult" value="1" min="1" max="20">
                                                        <button class="btn btn-outline-secondary Aplus-btn plusButton" type="button">+</button>
                                                        <h5>Number of children (-12)</h5>
                                                        <button class="btn btn-outline-secondary Cminus-btn minusButton" type="button">-</button>
                                                        <input class="cInputNumber" type="number" id="nrChild" name="nrChild" value="0" min="0" max="20">
                                                        <button class="btn btn-outline-secondary Cplus-btn plusButton" type="button">+</button>
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
                                                    <input type="hidden" name="restaurantId" id="restaurantId" value="<?= $restaurant->getRestaurantId() ?>">
                                                    <button class="btn btn-primary" type="submit" for="form">Continue</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of modal -->
                    <?php }
                    $foodTypesList = array();
                    foreach ($restaurantFoodTypes as $foodType) {
                        $foodTypesList[$foodType->getRestaurantID()][] = $foodType->getFoodTypeId();
                    }
                    ?>
                </div>
            </div>
            <div class="container" id="otherEventInformation">
                <div class="row" id="oERow">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h1>Jazz</h1>
                        <p>Haarlem Jazz is the premier event for all jazz lovers. We are here to provide a vibrant and
                            lively atmosphere for music fans to come together and enjoy the sounds of the genre.</p>
                        <a href="/Jazz" class="btn btn-primary">Go to Jazz</a>
                    </div>
                    <div class="col-md-6">
                        <h1>Stroll Through Haarlem</h1>
                        <p>The historical inner city of Haarlem features a lot of extraordinary monuments. Discover the
                            many interesting, beautiful and surprising monuments that this city makes unique through
                            this tour. </p>
                        <a href="/Stroll-Through-History" class="btn btn-primary">Go to Stroll though History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/yummy/restaurant.js"></script>
    <script src="../js/yummy/yummy.js"></script>