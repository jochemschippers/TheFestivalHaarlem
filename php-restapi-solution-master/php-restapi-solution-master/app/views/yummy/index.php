<!-- ----- HIER MOET HEADER/ NAV BAR ----- -->

<html lang="en">
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
                <h1>Yummy</h1> <!-- HIER DE TITLE VAN HET EVENT -->
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
            <div class="row">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio1">Dutch</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio2">Seafood</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio3">French</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio4">European</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio5">International</label>

                    <input type="radio" class="btn-check" name="btnradio" id="btnradio6" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio6">Clear selected</label>
                </div>
            </div>
        </div>
        <div class="border-box" id="restaurantBorder">
            <div class="row">
                <div class="col-md-2">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Restaurant Mr & Mrs</h5>
                            <h6 class="card-sub-title">Lange Veerstraat 4, <br> 2011 DB Haarlem, Netherlands</h6>
                            <p class="card-text">
                                Mr & Mrs is known for its quality Dutch cuisine and seafood. 
                                Interested? 
                            </p>
                            <a href="#" class="btn btn-primary">Menu and reservations</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Ratatouille</h5>
                            <h6 class="card-sub-title">Twijnderslaan 7, <br> 2012 BG Haarlem, Netherlands</h6>
                            <p class="card-text">           
                                This is the place to be for a chic French dining experience. Serving dinner A La Carte, here at Ratatouille you will experience a whole new level of dining.
                            </p>
                            <a href="#" class="btn btn-primary">Menu and reservations</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>

<?php 
include __DIR__ . '/../footer.php';
?>