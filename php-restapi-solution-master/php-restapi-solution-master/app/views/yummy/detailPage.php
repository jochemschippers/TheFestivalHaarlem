<?php
// Assuming the ID of the specific restaurant you want to display is stored in the $restaurantId variable
$restaurantId = 4;

// Create a new instance of the DetailPageService class
$detailPageController = new YummyController();

// Call the getRestaurant method to retrieve the restaurant information
$restaurant = $detailPageController->getOne($restaurantId);

// Call the getMenu method to retrieve the menu items for the restaurant
$menuItems = $detailPageController->getMenuItems($restaurantId);

// Call the getImage methode to retrieve the menu items for the page.
$images = $detailPageController->getImages($restaurantId);

// Use the retrieved data to display the restaurant and menu information on the page
?>

<?php 
include __DIR__ . '/../navbar.php';
?>

<html lang="en">
    <head>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Festival</title>

        <!-- ----- BOOTSTRAP EN CSS LINKS ----- -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">

        <link href="../css/yummy/detailPage.css" rel="stylesheet">
        <!-- ----- EINDE HEAD ----- -->
    </head>
    <body>  <!-- UIT DB GEBRUIK JE (YUMMYRESTAURANTS, RESTAURANTRESERVATIONS, RestaurantMenuItems, RestaurantImages, RestaurantFoodTypes) -->

            <?php
            foreach ($images as $image) {
            if ($image->GetImageIndex() == 1) {
            ?>
                <div class="border-box" id="titleBorder" style="background-image: url('/image/<?php echo $image->getImageLink(); ?>');">
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
                <div class="col-md-6" id="titleText">  <!-- PAS AAN NAAR EVENT PAGE OF DETAIL PAGE (AANTAL columns) -->
                    <h2><i><?= $restaurant[0]->getRestaurantName() ?></i></h2>  <!-- RESTAURANT NAME -->
                    <p><i><?= $restaurant[0]->getDescription() ?></i></p>     <!-- RESTAURANT DESCRIPTION -->
                </div>

                <?php
                    // assume $images is an array of images from the database

                    foreach ($images as $image) {
                    if ($image->GetImageIndex() == 2) {
                    ?>
                        <div class="border-box" id="restaurantLogo" style="background-image: url('/image/<?php echo $image->getImageLink(); ?>');"></div>
                    <?php
                        break; // break the loop once we find the image with GetImageIndex = 2
                    }
                    }
                ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" >
                    <div class="border-box" id="restaurantInfo">
                        <div class="row">
                            <div class="col-md-3">
                                <p>Restaurant type:</p>
                            </div>
                            <div class="col-md-5">
                                <p></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p>Head chef:</p>
                            </div>
                            <div class="col-md-5">
                                <p><i><?= $restaurant[0]->getHeadChef() ?></i> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p>Address:</p>
                            </div>
                            <div class="col-md-5">
                                <p><i><?= str_replace(',', ',<br>', $restaurant[0]->getAddress()) ?></i></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p>Star rating:</p>
                            </div>
                            <div class="col-md-5">
                                <?php for ($im = 1; $im <= $restaurant[0]->getAmountOfStars(); $im ++) { ?>
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
                        }catch (Exception $e) {
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
                        ?>

                        <h4>Starters</h4>
                        <?php foreach ($voorgerechten as $voorgerecht): ?>
                            <?php echo '<span style="font-size: 16px; font-weight: bold;">' . $voorgerecht->getName() . '</span> &euro; ' . $voorgerecht->getPrice() ?>
                            <p><i><?= $voorgerecht->getDescription() ?></i></p>
                        <?php endforeach; ?>

                        <h4>Main courses</h4>
                        <?php foreach ($hoofdgerechten as $hoofdgerecht): ?>
                            <?php echo '<span style="font-size: 16px; font-weight: bold;">' . $hoofdgerecht->getName() . '</span> &euro; ' . $hoofdgerecht->getPrice() ?>
                            <p><i><?= $hoofdgerecht->getDescription() ?></i></p>
                        <?php endforeach; ?>

                        <h4>Desserts</h4>
                        <?php foreach ($nagerechten as $nagerecht): ?>
                            <?php echo '<span style="font-size: 16px; font-weight: bold;">' . $nagerecht->getName() . '</span> &euro; ' . $nagerecht->getPrice() ?>
                            <p><i><?= $nagerecht->getDescription() ?></i></p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-3" id="foodPictures">
                    <?php
                        foreach ($images as $image) {
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
                        <i><?= $restaurant[0]->getStartTime()->format("H:i") ?></i>. Each session will last
                        <i><?php $duration = $restaurant[0]->getDuration()->format("H:i");
                        $hour = date("G.i", strtotime($duration)); echo $hour; ?></i>
                        hours.</p>     <!-- RESTAURANT SCEDULE AND PRICES -->
                </div>
                <div class="col-md-3" id="guestPrices">
                    <h3>Prices</h3>
                    <p>Adults: <i><?= $restaurant[0]->getAdultPrice() ?></i> </p>
                    <p>Children: <i><?= $restaurant[0]->getChildPrice() ?></i> </p> <!-- HERE RESTAURANT PRICES -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-8" id="reservation">
                    <a href="#" class="btn btn-primary">Make a reservation</a>    <!-- RESERVATION BUTTON -->
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
                    <p><i><?= str_replace(',', ',<br>', $restaurant[0]->getAddress()) ?></i></p> <!-- HERE CONTACT INFO EXTRA-->
                    <p><i><?= str_replace(',', ',<br>', $restaurant[0]->getContact()) ?></i></p> <!-- HERE CONTACT INFO EXTRA-->
                    
                </div>
                <?php
                    foreach ($images as $image) {
                        if ($image->GetImageIndex() == 3) {
                        ?>
                            <div class="col-md-6" id="bottomPicture" style="background-image: url('/image/<?php echo $image->getImageLink(); ?>');"></div>
                        <?php
                            break; // break the loop once we find the image with GetImageIndex = 3
                        }
                    }
                ?>
            </div>
        </div>
        <!-- -------- HERE END GETTING DATA FROM DATABASE -------- -->
    </body>
</html>

<?php
include __DIR__ . '/../footer.php';
?>