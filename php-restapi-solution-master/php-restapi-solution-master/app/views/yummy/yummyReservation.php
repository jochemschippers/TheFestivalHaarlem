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
                <?php $numberButtons = 1; ?>

                <?php
                // Set the start date and time for the sessions
                $start_datetime = $restaurant[0]->getStartTime();
                // Get the duration in minutes
                $duration_minutes = $restaurant[0]->getDuration()->format('i');
                // Get the duration in hours
                $duration_hours = $restaurant[0]->getDuration()->format('H');
                // Create a DateInterval object using the duration in hours and minutes
                $session_duration = new DateInterval('PT' . $duration_hours . 'H' . $duration_minutes . 'M');
                // Initialize an empty array to store the session times
                $session_times = array();
                // Loop through each session and display the date and time
                for ($i = 1; $i <= $restaurant[0]->getAmountSessions(); $i++) {
                    // Format the session date and time
                    $session_time = $start_datetime->format('H:i');
                    // Add the session time to the array
                    array_push($session_times, $session_time);
                    // Increase the start date and time by 1.5 hours for the next session
                    $start_datetime->add($session_duration);
                }
                ?>

                <div class="row text-center">
                    HIER LOOP VOOR EVENT ID EN ACTIVITY ID
                    <h1>Make a reservation for:</h1>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h2>Select your arrival date and time</h2>
                    </div>
                    <div class="col-md-6">
                        <h2>Your reservation details</h2>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group"> -->
                    <div class="col-md-3">
                        <h4><ins>Thursday 26 July</ins></h4>
                        <?php
                        foreach ($session_times as $time) { ?>
                            <!-- Display the session date and time with the session number -->
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $numberButtons ?>"
                                autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio<?php echo $numberButtons ?>"><?php echo "<b>Session $i: " . $time . "</b>" ?></label><br>

                            <!-- Increase the start date and time by 1.5 hours for the next session -->
                            <?php $numberButtons++;
                        } ?>
                    </div>
                    <div class="col-md-3">
                        <h4><ins>Friday 27 July</ins></h4>
                        <?php
                        foreach ($session_times as $time) { ?>
                            <!-- Display the session date and time with the session number -->
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $numberButtons ?>"
                                autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio<?php echo $numberButtons ?>"><?php echo "<b>Session $i: " . $time . "</b>" ?></label><br>

                            <!-- Increase the start date and time by 1.5 hours for the next session -->
                            <?php $numberButtons++;
                        } ?>
                    </div>
                    <div class="col-md-4">
                        <h4>Name on reservation</h4>
                        <input class="form-control" type="text" placeholder="Enter name"
                            aria-label="default input example">
                    </div>
                    <div class="col-md-2">
                        <h4>Phone number</h4>
                        <input class="form-control" id="phoneNr" type="number" placeholder="00 123456789"
                            aria-label="default input example">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <h2>Group size</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h4><ins>Saturday 28 July</ins></h4>
                        <?php
                        foreach ($session_times as $time) { ?>
                            <!-- Display the session date and time with the session number -->
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $numberButtons ?>"
                                autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio<?php echo $numberButtons ?>"><?php echo "<b>Session $i: " . $time . "</b>" ?></label><br>

                            <!-- Increase the start date and time by 1.5 hours for the next session -->
                            <?php $numberButtons++;
                        } ?>
                    </div>
                    <div class="col-md-3">
                        <h4><ins>Sunday 29 July</ins></h4>
                        <?php
                        foreach ($session_times as $time) { ?>
                            <!-- Display the session date and time with the session number -->
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $numberButtons ?>"
                                autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio<?php echo $numberButtons ?>"><?php echo "<b>Session $i: " . $time . "</b>" ?></label><br>

                            <!-- Increase the start date and time by 1.5 hours for the next session -->
                            <?php $numberButtons++;
                        } ?>
                    </div>
                    <div class="col-6">
                        <h4>Number of adults</h4>

                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary Aminus-btn" type="button">-</button>
                            </div>
                            <input type="number" id="nrAdult" value="1" min="1" max="20">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary Aplus-btn" type="button">+</button>
                            </div>
                        </div>

                        <h4>Number of children (-12)</h4>

                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary Cminus-btn" type="button">-</button>
                            </div>
                            <input type="number" id="nrChild" value="0" min="0" max="20">
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
                            <textarea class="form-control" id="textArea" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border" id="overview">
                            <p>Number of adults: <span id="adults">1</span></p>
                            <p>Number Children: <span id="children">0</span></p>
                            <p>Reservation fee* (<span id="group">1</span>): </p>
                            <hr>
                            <p>Total price: </p>
                        </div>
                        <p>*A reservation fee of €10,- pp. will be administerred.<br>
                            This fee will be deducted from the final check on visiting the restaurant.
                        </p>
                        <input class="btn btn-primary" type="submit" value="Continue">
                        <button type="button" onclick="hideOverlay();" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // <<<<<<<<<<-------------- HIER OVERLAY ---------------->>>>>>>>>>>>

        // const overlayContainer = document.querySelector('.overlay-container');
        // const overlay = document.querySelector('.overlay');

        // function showOverlay() {
        //     overlayContainer.style.display = 'flex';
        // }

        // function hideOverlay() {
        //     overlayContainer.style.display = 'none';
        // }

        // // show the overlay
        // // showOverlay();

        // hideOverlay();

        // hide the overlay after 5 seconds
        // setTimeout(hideOverlay, 5000);

        // document.addEventListener('mousedown', (event) => {
        //     if (!overlayContainer.contains(event.target)) {
        //         overlayContainer.style.display = 'none';
        //     }
        // });

        // <<<<<<<<<<-------------- EINDE OVERLAY --------------->>>>>>>>>>>>

        // Get the input element and plus/minus buttons
        const adultInput = document.getElementById("nrAdult");
        const childInput = document.getElementById("nrChild");

        adultInput.addEventListener("change", function (event) {
            // If the input value is above the max value, set it to the max value
            if (adultInput.value > parseInt(adultInput.max)) {
                adultInput.value = adultInput.max;
            }
            if (adultInput.value < adultInput.min) {
                adultInput.value = adultInput.min;
            }
            document.getElementById("adults").textContent = adultInput.value;
            updateGroupNr();
        });

        childInput.addEventListener("change", function (event) {
            // If the input value is above the max value, set it to the max value
            if (childInput.value > parseInt(childInput.max)) {
                childInput.value = childInput.max;
            }
            if (childInput.value < childInput.min) {
                childInput.value = childInput.min;
            }
            document.getElementById("children").textContent = childInput.value;
            updateGroupNr();
        });
        // <<<<<<<<-------------- HIER PLUS EN MIN KNOPPEN ------------>>>>>>>>
        const aMinusBtn = document.querySelector(".Aminus-btn");
        const aPlusBtn = document.querySelector(".Aplus-btn");

        const cMinusBtn = document.querySelector(".Cminus-btn");
        const cPlusBtn = document.querySelector(".Cplus-btn");

        // Add event listeners to plus/minus buttons of Adult
        aMinusBtn.addEventListener("click", () => {
            if (adultInput.value > 1) {
                adultInput.value = parseInt(adultInput.value) - 1;
                document.getElementById("adults").textContent = adultInput.value;
                updateGroupNr();
            }
        });

        aPlusBtn.addEventListener("click", () => {
            if (adultInput.value < 20) {
                adultInput.value = parseInt(adultInput.value) + 1;
                document.getElementById("adults").textContent = adultInput.value;
                updateGroupNr();
            }
        });

        // Add event listeners to plus/minus buttons of Child
        cMinusBtn.addEventListener("click", () => {
            if (childInput.value > 0) {
                childInput.value = parseInt(childInput.value) - 1;
                document.getElementById("children").textContent = childInput.value;
                updateGroupNr();
            }
        });

        cPlusBtn.addEventListener("click", () => {
            if (childInput.value < 20) {
                childInput.value = parseInt(childInput.value) + 1;
                document.getElementById("children").textContent = childInput.value;
                updateGroupNr();
            }
        });
        // <<<<<<<<---------------- EINDE KNOPPEN ------------------>>>>>>>>>

        function updateGroupNr() {
            groupNr = parseInt(adultInput.value) + parseInt(childInput.value);
            document.getElementById("group").textContent = groupNr;
        }

    </script>

</body>

</html>