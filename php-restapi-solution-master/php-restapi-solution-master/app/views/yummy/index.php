<?php 

$yummyController = new YummyController();

// Call the getRestaurant method to retrieve the restaurant information
$restaurants = $yummyController->getAll();

$foodTypes = $yummyController->getFoodTypes();

$restaurantFoodTypes = $yummyController->getRestaurantFoodTypes();

include __DIR__ . '/../navbar.php';
?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Festival</title>

        <!-- ----- BOOTSTRAP EN CSS LINKS ----- -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="../css/yummy/yummy.css" rel="stylesheet">

        <!-- ----- EINDE HEAD ----- -->
    </head>
    <body>
        
        <div class="border-box" id="titleBorder"> <!-- <<<<<<< GEEF DIT EEN IMAGE VIA CSS -->
            <div class="container" id="titleContainer">
                <h1>Yummy!</h1> <!-- HIER DE TITLE VAN HET EVENT -->
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" id="titleText">  <!-- PAS AAN NAAR EVENT PAGE OF DETAIL PAGE (AANTAL columns) -->
                    <h2>Experience food at its best</h2>
                    <p>
                        You say food, we say Yummy! One of the most anticipated and well-known food festival in North Holland, 
                        specialising in showing its visitors all the best the beautiful city of Haarlem has to offer. Get ready to get a taste of heaven.
                        <br></br>Below you can choose between the participating restaurants.
                    </p>
                </div>
                <div class="col-md-4">
                    HIER KOMT OF EEN IMAGE OF GAAT WEG VOOR LANGERE TEKST <!-- GAAT WEG OF BLIJFT (LIGT AAN ONTWERP) -->
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
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio<?php echo $i ?>" onclick="filterSelection('<?php echo strtolower($type->getFoodTypeName()) ?> ')">
                    <label class="btn btn-outline-primary" for="btnradio<?php echo $i ?>"><?php echo $type->getFoodTypeName() ?></label>
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
                            <div class="filterDiv  <?php echo strtolower(trim($foodTypeNames)) ?> col-md-2 ">
                                <div class="card" style="width: 18rem;">
                                    <img src="/image/<?php echo $restaurant->getBannerImage() ?>" class="card-img-top" alt="Logo" id="cardLogo">
                                    <div class="card-body d-flex flex-column" id="cardBody">
                                        <h5 class="card-title"><i><?= $restaurant->getRestaurantName() ?></i></h5>
                                        <h6 class="card-sub-title"><i><?= str_replace(',', ',<br>', $restaurant->getAddress()) ?></i></h6>
                                        <p class="card-text"><i><?= $restaurant->getCardDescription() ?></i></p>

                                        <a class="btn btn-primary mt-auto" onclick="getRestaurantId(<?php echo $restaurant->getRestaurantId(); ?>)">Menu and info</a>

                                        <script>
                                        function getRestaurantId(restaurantId) {
                                            // Do something with the restaurantId variable
                                            console.log('Restaurant ID:', restaurantId);

                                            // Redirect to the restaurant page with the restaurantId variable as a query parameter
                                            window.location.href = '/yummy/restaurant?restaurantId=' + restaurantId;
                                        }
                                        </script>

                                        <a href="#" class="btn btn-primary">Make your reservation</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    $foodTypesList = array();
                    foreach ($restaurantFoodTypes as $foodType) {
                        $foodTypesList[$foodType->getRestaurantID()][] = $foodType->getFoodTypeId();
                    }
                    
                    echo "<script>";
                    echo "var foodTypesList = " . json_encode($foodTypesList) . ";";
                    echo "</script>";
                    ?>
                </div>
            </div>

            <script>

            filterSelection("all")
            function filterSelection(c) {
            var x, i;
            x = document.getElementsByClassName("filterDiv");
            if (c == "all") c = "";
            // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
            for (i = 0; i < x.length; i++) {
                RemoveClass(x[i], "show");
                if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
            }
            }

            // Show filtered elements
            function AddClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
                }
            }
            }

            // Hide elements that are not selected
            function RemoveClass(element, name) {
            var i, arr1, arr2;
            arr1 = element.className.split(" ");
            arr2 = name.split(" ");
            for (i = 0; i < arr2.length; i++) {
                while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
                }
            }
            element.className = arr1.join(" ");
            }

            // Add active class to the current control button (highlight it)
            var btnContainer = document.getElementById("myBtnContainer");
            var btns = btnContainer.getElementsByClassName("btn");
            for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
            }

            </script>

           

           

        <div class="container" id="otherEventInformation">
            <div class="row" id="oERow">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h1>Jazz</h1>
                    <p>Haarlem Jazz is the premier event for all jazz lovers. We are here to provide a vibrant and lively atmosphere for music fans to come together and enjoy the sounds of the genre.</p>
                    <a href="/Jazz" class="btn btn-primary">Go to Jazz</a>
                </div>
                <div class="col-md-6">
                    <h1>Stroll Through Haarlem</h1>
                    <p>The historical inner city of Haarlem features a lot of extraordinary monuments. Discover the many interesting, beautiful and surprising monuments that this city makes unique through this tour. </p>
                    <a href="/Stroll Through History" class="btn btn-primary">Go to Stroll though History</a>
                </div>
            </div>
        </div>


    </body>
</html>

<?php
include __DIR__ . '/../footer.php';
?>