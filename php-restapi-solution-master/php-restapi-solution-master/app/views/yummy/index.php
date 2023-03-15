<?php 
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

        <link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
        <script src="extensions/filter-control/bootstrap-table-filter-control.js"></script>

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

            <!-- <div class="row">
      <div class="col-md-12">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary filter-btn" data-filter="all">All</button>
          <button type="button" class="btn btn-primary filter-btn" data-filter="fruit">Fruit</button>
          <button type="button" class="btn btn-primary filter-btn" data-filter="vegetable">Vegetable</button>
        </div>
      </div>
    </div>

    <div class="row mt-3 filter-items">
      <div class="col-md-4 mb-3 fruit">
        <div class="card">
          <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Apple</h5>
            <p class="card-text">A juicy fruit.</p>
          </div>
        </div>
      </div> -->

      <div class="row">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" data-filter="0">
                    <label class="btn btn-outline-primary" for="btnradio1">Dutch</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" data-filter="1">
                    <label class="btn btn-outline-primary" for="btnradio2">Seafood</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" data-filter="2">
                    <label class="btn btn-outline-primary" for="btnradio3">French</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off" data-filter="3">
                    <label class="btn btn-outline-primary" for="btnradio4">European</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off" data-filter="4">
                    <label class="btn btn-outline-primary" for="btnradio5">International</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off" data-filter="Clear" checked>
                    <label class="btn btn-outline-primary" for="btnradio6">Clear selected</label>
                </div>
                </div>

                <div class="border-box" id="restaurantBorder">
                <div class="row filter-items">
                    <?php
                    foreach ($restaurants as $restaurant) {
                        $restaurantId = $restaurant->getRestaurantId();
                        $foodTypesList = '';
                        foreach ($foodTypes as $foodType) {
                            if ($foodType->getRestaurantID() == $restaurant->getRestaurantID()) {
                                $foodTypesList .= $foodType->getFoodTypeName() . ' ';
                            }
                        }
                    ?>
                    <div class="col-md-2 <?php echo strtolower(trim($foodTypesList)) ?>">
                        <div class="card" style="width: 18rem;">
                            <img src="/image/<?php echo $restaurant->getBannerImage() ?>" class="card-img-top" alt="Logo" id="cardLogo">
                            <div class="card-body d-flex flex-column" id="cardBody">
                                <h5 class="card-title"><i><?= $restaurant->getRestaurantName() ?></i></h5>
                                <h6 class="card-sub-title"><i><?= str_replace(',', ',<br>', $restaurant->getAddress()) ?></i></h6>
                                <p class="card-text"><i><?= $restaurant->getCardDescription() ?></i></p>
                                <!-- <a href="/yummy/restaurant" class="btn btn-primary mt-auto">Menu and info</a> -->

                                <a href="#" class="btn btn-primary mt-auto" onclick="getRestaurantId(<?php echo $restaurant->getRestaurantId(); ?>)">Menu and info</a>

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
                    <?php } ?>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                $('.filter-btn').click(function() {
                    var filter = $(this).data('filter');
                    if (filter == 'all') {
                    $('.filter-items').find('.col-md-4').show();
                    } else {
                    $('.filter-items').find('.col-md-4').hide();
                    $('.filter-items').find('.' + filter).show();
                    }
                });
                });
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