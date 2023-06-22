<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="../css/reservation.css" rel="stylesheet">

    <title>The Festival</title>
</head>

<body>

    <!-- HIER LOOP VOOR EVENT ID EN ACTIVITY ID -->
    <div class="overlay-container">
        <div class="overlay">
            <div class="container" id="overlay">
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
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio1">Radio 1</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio2">Radio 2</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio3">Radio 3</label>
                        </div>
                        <div class="col-md-3">
                            <h4><ins>Friday 27 July</ins></h4>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio4">Radio 4</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio5">Radio 5</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio6">Radio 6</label>
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
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio7" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio7">Radio 7</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio8" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio8">Radio 8</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio9" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio9">Radio 9</label>
                        </div>
                        <div class="col-md-3">
                            <h4><ins>Sunday 29 July</ins></h4>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio10" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio10">Radio 10</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio11" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio11">Radio 11</label><br>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio12" autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio12">Radio 12</label>
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
                                <p>Adults(): </p>
                                <p>Children(): </p>
                                <p>Reservation fee: </p>
                                <hr>
                                <p>Total price: </p>
                            </div>
                            <p>*A reservation fee of €10,- pp. will be administerred.<br>
                                This fee will be deducted from the final check on visiting the restaurant.
                            </p>
                            <input class="btn btn-primary" type="submit" value="Continue">
                            <button type="button" class="btn btn-danger" id="closeModal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // <<<<<<<<<<-------------- HIER OVERLAY ---------------->>>>>>>>>>>>

            const overlayContainer = document.querySelector('.overlay-container');

            function showOverlay() {
                overlayContainer.style.display = 'flex';
            }

            function hideOverlay() {
                overlayContainer.style.display = 'none';
            }

            // show the overlay
            showOverlay();

            // hide the overlay after 5 seconds
            // setTimeout(hideOverlay, 5000);

            // <<<<<<<<<<-------------- EINDE OVERLAY --------------->>>>>>>>>>>>

            // <<<<<<<<-------------- HIER PLUS EN MIN KNOPPEN ------------>>>>>>>>
            // Get the input element and plus/minus buttons
            const adultInput = document.getElementById("nrAdult");
            const aMinusBtn = document.querySelector(".Aminus-btn");
            const aPlusBtn = document.querySelector(".Aplus-btn");
            const childInput = document.getElementById("nrChild");
            const cMinusBtn = document.querySelector(".Cminus-btn");
            const cPlusBtn = document.querySelector(".Cplus-btn");

            // Add event listeners to plus/minus buttons of Adult
            aMinusBtn.addEventListener("click", () => {
                if (adultInput.value > 1) {
                    adultInput.value = parseInt(adultInput.value) - 1;
                }
            });

            aPlusBtn.addEventListener("click", () => {
                if (adultInput.value < 20) {
                    adultInput.value = parseInt(adultInput.value) + 1;
                }
            });

            // Add event listeners to plus/minus buttons of Child
            cMinusBtn.addEventListener("click", () => {
                if (childInput.value > 0) {
                    childInput.value = parseInt(childInput.value) - 1;
                }
            });

            cPlusBtn.addEventListener("click", () => {
                if (childInput.value < 20) {
                    childInput.value = parseInt(childInput.value) + 1;
                }
            });
            // <<<<<<<<---------------- EINDE KNOPPEN ------------------>>>>>>>>>
        </script>
</body>

</html>