<body>
    <!-- UIT DB GEBRUIK JE (YUMMYRESTAURANTS, timeSlotsYummy, RestaurantMenuItems, RestaurantImages, RestaurantFoodTypes) -->

    <link href="../css/yummy/detailPage.css" rel="stylesheet">
    <link href="../css/reservation.css" rel="stylesheet">

    <?php
    foreach ($images as $image) {
        if ($image->GetImageIndex() == 1) {
    ?>
            <div class="border-box" id="titleBorder" style="background-image: url('/image/<?= $image->getImageLink(); ?>');">
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

                <!-- RESTAURANT DESCRIPTION -->
                <?= $restaurant[0]->getDescription() ?>

            </div>

            <?php
            // assume $images is an array of images from the database

            foreach ($images as $image) {
                if ($image->GetImageIndex() == 2) {
            ?>
                    <div class="border-box" id="restaurantLogo" style="background-image: url('/image/<?= $image->getImageLink(); ?>');"></div>
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
                    <?php foreach ($voorgerechten as $voorgerecht) : ?>
                        <?= '<span style="font-size: 16px; font-weight: bold;">' . $voorgerecht->getName() . '</span> &euro; ' . $voorgerecht->getPrice() ?>
                        <p><i>
                                <?= $voorgerecht->getDescription() ?>
                            </i></p>
                    <?php endforeach; ?>

                    <h4>Main courses</h4>
                    <?php foreach ($hoofdgerechten as $hoofdgerecht) : ?>
                        <?= '<span style="font-size: 16px; font-weight: bold;">' . $hoofdgerecht->getName() . '</span> &euro; ' . $hoofdgerecht->getPrice() ?>
                        <p><i>
                                <?= $hoofdgerecht->getDescription() ?>
                            </i></p>
                    <?php endforeach; ?>

                    <h4>Desserts</h4>
                    <?php foreach ($nagerechten as $nagerecht) : ?>
                        <?= '<span style="font-size: 16px; font-weight: bold;">' . $nagerecht->getName() . '</span> &euro; ' . $nagerecht->getPrice() ?>
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
                <h3>Our schedule and prices </h3>
                <p>We have planned 3 sessions the first of which will start at <?= $timeSlotsYummy[0]->getStartTime()->format("H:i") ?>.
                    Each session will last
                    <?php
                    $duration = $timeSlotsYummy[0]->getEndTime()->diff($timeSlotsYummy[0]->getStartTime());
                    $hour = $duration->h + ($duration->i / 60);
                    ?>
                    <?= $hour ?> hours.
                </p>
                <!-- RESTAURANT SCHEDULE AND PRICES -->
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
                <!-- <a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary btn-lg">Make a
                    reservation</a> -->

                <a onclick="showOverlay(<?= $restaurantId ?>);" class="btn btn-primary btn-lg">Make a
                    reservation</a>
                <p>Any special requests? <br>
                    Please put that in your reservation.</p>
            </div>
            <div class="col-md-3" id="sessionPrices">

                <h4>Sessions</h4>
                <?php
                $time = 0;
                for ($i = 1; $i <= $restaurant[0]->getAmountSessions(); $i++) { ?>

                    <p><?= $timeSlotsYummy[$time++]->getStartTime()->format('H:i') ?></p>

                <?php }
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
                    <div class="col-md-6" id="bottomPicture" style="background-image: url('/image/<?= $image->getImageLink(); ?>');"></div>
            <?php
                    break; // break the loop once we find the image with GetImageIndex = 3
                }
            }
            ?>

        </div>
    </div>

    <!-- MODAL OVERLAY -->

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

    <script>
    
</script>

    <script src="../js/yummy/restaurant.js"></script>
</body>