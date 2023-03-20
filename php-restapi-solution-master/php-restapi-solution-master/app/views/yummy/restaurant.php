<body>
    <!-- UIT DB GEBRUIK JE (YUMMYRESTAURANTS, RESTAURANTRESERVATIONS, RestaurantMenuItems, RestaurantImages, RestaurantFoodTypes) -->




    <?php
    foreach ($images as $image) {
        if ($image->GetImageIndex() == 1) {
            ?>
            <div class="border-box" id="titleBorder"
                style="background-image: url('/image/<?php echo $image->getImageLink(); ?>');">
                <div class="container" id="titleContainer">
                    <h1>Yummy</h1>
                    <h5>Discover Haarlem's Gastronomic Wonders: A Feast for the Senses!</h5>
                </div>
            </div>
            <?php
            break; // break the loop once we find the image with GetImageIndex = 1
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6" id="titleText"> <!-- PAS AAN NAAR EVENT PAGE OF DETAIL PAGE (AANTAL columns) -->
                <h2><i>
                        <?= $restaurant[0]->getRestaurantName() ?>
                    </i></h2> <!-- RESTAURANT NAME -->
                <p><i>
                        <?= $restaurant[0]->getDescription() ?>
                    </i></p> <!-- RESTAURANT DESCRIPTION -->
            </div>

            <?php
            // assume $images is an array of images from the database
            
            foreach ($images as $image) {
                if ($image->GetImageIndex() == 2) {
                    ?>
                    <div class="border-box" id="restaurantLogo"
                        style="background-image: url('/image/<?php echo $image->getImageLink(); ?>');"></div>
                    <?php
                    break; // break the loop once we find the image with GetImageIndex = 2
                }
            }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="border-box" id="restaurantInfo">
                    <div class="row">
                        <div class="col-md-3">
                            <p>Restaurant type: </p>
                        </div>
                        <div class="col-md-5">
                            <?php
                            $foodTypesOutput = '';
                            foreach ($restaurantFoodTypes as $foodType) {
                                if ($foodType->getRestaurantID() == $restaurantId) {
                                    $foodTypesOutput .= $foodType->getFoodTypeName() . ", ";
                                }
                            }
                            echo rtrim($foodTypesOutput, ", ");
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Head chef:</p>
                        </div>
                        <div class="col-md-5">
                            <p><i>
                                    <?= $restaurant[0]->getHeadChef() ?>
                                </i> </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Address:</p>
                        </div>
                        <div class="col-md-5">
                            <p><i>
                                    <?= str_replace(',', ',<br>', $restaurant[0]->getAddress()) ?>
                                </i></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Star rating:</p>
                        </div>
                        <div class="col-md-5">
                            <?php for ($im = 1; $im <= $restaurant[0]->getAmountOfStars(); $im++) { ?>
                                <img src="/image/yummy/detail/star.png" width="20" height="20" alt="Yummy Start Image">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" id="restaurantLocation">

                <?php
                try {
                    $address = $restaurant[0]->getAddress();
                    // Split the address into street, postal code, and city
                    list($street, $postal_code, $city) = preg_split("/[,\/]/", $address);
                    // Remove any leading or trailing whitespace from the components
                    $street = trim($street);
                    $postal_code = trim($postal_code);
                    $city = trim($city);

                    // Construct the URL for the Google Maps Geocoding API
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($street . "," . $postal_code . "," . $city) . "&key=AIzaSyAKJHajPT4KF2mNhgUQLbrJDnvhcImFkS8";

                    // Retrieve the latitude and longitude from the API response
                    $response = file_get_contents($url);
                    $data = json_decode($response);

                    // Construct the URL for the Google Maps Embed API
                    $url = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d0.0!2d!3d!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s$street%2C%20$postal_code%20$city!2s$street%2C%20$postal_code%20$city!5e0!3m2!1sen!2sus!4v1541431408042";

                    // Embed the Google Maps location in HTML using an iframe element
                    echo '<iframe src="' . $url . '" width="700" height="250" frameborder="0" style="border: 2px solid black;" allowfullscreen></iframe>';
                } catch (Exception $e) {
                    echo "Could not retrieve location information from Google Maps API. $e";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="margin-top: 50px;">
                <div class="border-box" id="restaurantMenu">

                    <h1>Menu Items:</h1>

                    <?php
                    $voorgerechten = [];
                    $hoofdgerechten = [];
                    $nagerechten = [];

                    foreach ($menuItems as $menuItem) {
                        switch ($menuItem->getCourseID()) {
                            case 0:
                                $voorgerechten[] = $menuItem;
                                break;
                            case 1:
                                $hoofdgerechten[] = $menuItem;
                                break;
                            case 2:
                                $nagerechten[] = $menuItem;
                                break;
                            default:
                            // do nothing
                        }
                    }

                    // function checkSpecialty($item){
                    //     switch($item){
                    //         case($item ==)
                    
                    //     }
                    // }
                    ?>

                    <h4>Starters</h4>
                    <?php foreach ($voorgerechten as $voorgerecht): ?>
                        <?php echo '<span style="font-size: 16px; font-weight: bold;">' . $voorgerecht->getName() . '</span> &euro; ' . $voorgerecht->getPrice() ?>
                        <p><i>
                                <?= $voorgerecht->getDescription() ?>
                            </i></p>
                    <?php endforeach; ?>

                    <h4>Main courses</h4>
                    <?php foreach ($hoofdgerechten as $hoofdgerecht): ?>
                        <?php echo '<span style="font-size: 16px; font-weight: bold;">' . $hoofdgerecht->getName() . '</span> &euro; ' . $hoofdgerecht->getPrice() ?>
                        <p><i>
                                <?= $hoofdgerecht->getDescription() ?>
                            </i></p>
                    <?php endforeach; ?>

                    <h4>Desserts</h4>
                    <?php foreach ($nagerechten as $nagerecht): ?>
                        <?php echo '<span style="font-size: 16px; font-weight: bold;">' . $nagerecht->getName() . '</span> &euro; ' . $nagerecht->getPrice() ?>
                        <p><i>
                                <?= $nagerecht->getDescription() ?>
                            </i></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-3" id="foodPictures">
                <?php foreach ($images as $image) {
                    if ($image->getImageIndex() > 3) {
                        echo "<img src='/image/{$image->getImageLink()}' alt='picture'>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8" id="scedulePrice">
                <h3>Our scedule and prices </h3>
                <p>We have planned 3 sessions the first of which will start at
                    <i>
                        <?= $restaurant[0]->getStartTime()->format("H:i") ?>
                    </i>. Each session will last
                    <i>
                        <?php $duration = $restaurant[0]->getDuration()->format("H:i");
                        $hour = date("G.i", strtotime($duration));
                        echo $hour; ?>
                    </i>
                    hours.
                </p> <!-- RESTAURANT SCEDULE AND PRICES -->
            </div>
            <div class="col-md-3" id="guestPrices">
                <h3>Prices</h3>
                <p>Adults: <i>
                        <?= $restaurant[0]->getAdultPrice() ?>
                    </i> </p>
                <p>Children: <i>
                        <?= $restaurant[0]->getChildPrice() ?>
                    </i> </p> <!-- HERE RESTAURANT PRICES -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-8" id="reservation">
                <a onclick="showOverlay();" class="btn btn-primary btn-lg">Make a reservation</a>
                <p>Any special requests? <br>
                    Please put that in your reservation.</p>
            </div>
            <div class="col-md-3" id="sessionPrices">
                <?php
                // Set the start date and time for the sessions
                $start_datetime = $restaurant[0]->getStartTime();
                // Get the duration in minutes
                $duration_minutes = $restaurant[0]->getDuration()->format('i');
                // Get the duration in hours
                $duration_hours = $restaurant[0]->getDuration()->format('H');
                // Create a DateInterval object using the duration in hours and minutes
                $session_duration = new DateInterval('PT' . $duration_hours . 'H' . $duration_minutes . 'M');
                // Loop through each session and display the date and time
                for ($i = 1; $i <= $restaurant[0]->getAmountSessions(); $i++) {
                    // Format the session date and time
                    $session_time = $start_datetime->format('H:i');
                    // Display the session date and time with the session number
                    echo "<b>Session $i: " . $session_time . "</b><br>";
                    // Increase the start date and time by 1.5 hours for the next session
                    $start_datetime->add($session_duration);
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5" id="contactBottom">
                <h4>Contact</h4>
                <p><i>
                        <?= str_replace(',', ',<br>', $restaurant[0]->getAddress()) ?>
                    </i></p> <!-- HERE CONTACT INFO EXTRA-->
                <p><i>
                        <?= str_replace(',', ',<br>', $restaurant[0]->getContact()) ?>
                    </i></p> <!-- HERE CONTACT INFO EXTRA-->

            </div>
            <?php
            foreach ($images as $image) {
                if ($image->GetImageIndex() == 3) {
                    ?>
                    <div class="col-md-6" id="bottomPicture"
                        style="background-image: url('/image/<?php echo $image->getImageLink(); ?>');"></div>
                    <?php
                    break; // break the loop once we find the image with GetImageIndex = 3
                }
            }
            ?>

        </div>
    </div>
    <!-- -------- HERE END GETTING DATA FROM DATABASE -------- -->

    <!-- HIER OVERLAY -->

    <div class="overlay-container">
        <div class="overlay">
            <div class="container" id="overlay">
                <?php $numberButtons = 1; ?>
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
                        // Set the start date and time for the sessions

                        $start_datetime = $restaurant[0]->getStartTime();
                        // Get the duration in minutes
                        $duration_minutes = $restaurant[0]->getDuration()->format('i');
                        // Get the duration in hours
                        $duration_hours = $restaurant[0]->getDuration()->format('H');
                        // Create a DateInterval object using the duration in hours and minutes
                        $session_duration = new DateInterval('PT' . $duration_hours . 'H' . $duration_minutes . 'M');
                        // Loop through each session and display the date and time
                        for ($i = 1; $i <= $restaurant[0]->getAmountSessions(); $i++) {
                            // Format the session date and time
                            $session_time = $start_datetime->format('H:i'); ?>
                            <!-- Display the session date and time with the session number -->

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $numberButtons?>"
                                autocomplete="off">
                            <label class="btn btn-outline-primary w-100" for="btnradio<?php echo $numberButtons?>"><?php echo "<b>Session $i: " . $session_time . "</b>"?></label><br>


                            <!-- Increase the start date and time by 1.5 hours for the next session -->
                            <?php $start_datetime->add($session_duration);
                            $numberButtons++;
                        } 
                        ?>


                        <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-primary w-100" for="btnradio2">Radio 2</label><br>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn btn-outline-primary w-100" for="btnradio3">Radio 3</label> -->
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
                        <button type="button" onclick="hideOverlay();" class="btn btn-danger">Cancel</button>
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
        // showOverlay();

        hideOverlay();

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

    <!-- EINDE OVERLAY -->

</body>