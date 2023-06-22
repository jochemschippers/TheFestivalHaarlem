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
                <a class="btn btn-warning col-6" onclick="getRandomRestaurantId(<?php echo json_encode($restaurantIDs); ?>)">
                    Surprise me!
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" id="titleText">
            </div>
            <div class="col-md-4">
            </div>
            <div class="row text-center">
                <h1>Participating Restaurants</h1>
            </div>
            <div class="row">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <?php
                    $foodTypeNames = [];
                    $i = 0;
                    foreach ($foodTypes as $type) {
                        $foodTypeName = $type->getFoodTypeName();
                        if (in_array($foodTypeName, $foodTypeNames)) {
                            // foodTypeId is already in the list, do nothing
                        } else {
                            array_push($foodTypeNames, $foodTypeName); ?>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio<?= $i ?>" onclick="filterSelection('<?= strtolower($type->getFoodTypeName()) ?> ')">
                            <label class="btn btn-outline-warning" for="btnradio<?= $i ?>"><?= $type->getFoodTypeName() ?></label>
                    <?php $i++; }
                    } ?>
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" onclick="filterSelection('all')" checked>
                    <label class="btn btn-outline-warning" for="btnradio6">Clear selected</label>
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

                                    <a class="btn btn-warning mt-auto" onclick="getRestaurantId(<?= $restaurant->getRestaurantId(); ?>)">Menu and
                                        info</a>
                                </div>
                            </div>
                        </div>                        
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
                <div class="row justify-content-evenly" id="eventLinks">
                    <div class="col-md-5">
                        <h1>Jazz</h1>
                        <p>Haarlem Jazz is the premier event for all jazz lovers. We are here to provide a vibrant and
                            lively atmosphere for music fans to come together and enjoy the sounds of the genre.</p>
                        <a href="/Jazz" class="btn btn-warning">Go to Jazz</a>
                    </div>
                    <div class="col-md-5">
                        <h1>Stroll Through Haarlem</h1>
                        <p>The historical inner city of Haarlem features a lot of extraordinary monuments. Discover the
                            many interesting, beautiful and surprising monuments that this city makes unique through
                            this tour. </p>
                        <a href="/Stroll-Through-History" class="btn btn-warning">Go to Stroll though History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/yummy/restaurant.js"></script>
    <script src="../js/yummy/yummy.js"></script>