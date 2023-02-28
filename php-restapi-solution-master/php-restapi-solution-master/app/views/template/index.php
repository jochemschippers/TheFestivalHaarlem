<!-- ----- HIER MOET HEADER/ NAV BAR ----- -->

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title> <!-- <<<<<<< HIER ANDERE TITLE -->

        <!-- ----- BOOTSTRAP EN CSS LINKS ----- -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="../css/template.css" rel="stylesheet"> <!-- ---- PAS FILE NAAM AAN ---- KOPIEER DE TEMPLATE CSS -->
        <!-- ----- EINDE HEAD ----- -->
    </head>
    <body>
        
    <div class="border-box"> <!-- <<<<<<< GEEF DIT EEN IMAGE VIA CSS -->
        <div class="container" id="titleContainer">
            <h1>EVENT TITLE</h1> <!-- HIER DE TITLE VAN HET EVENT -->
        </div>
    </div>
    <div class="container">
    <div class="row">
    <div class="col-md-5" id="titleText">  <!-- PAS AAN NAAR EVENT PAGE OF DETAIL PAGE (AANTAL columns) -->
        <h2>TITLE</h2>  <!-- EDIT DIT -->
        <p>TEXT</p>     <!-- EDIT DIT -->
    </div>
    <div class="col-md-5">
      HIER KOMT OF EEN IMAGE OF GAAT WEG VOOR LANGERE TEKST <!-- GAAT WEG OF BLIJFT (LIGT AAN ONTWERP) -->
    </div>    
  </div>
        
    </div>


    </body>
</html>

<?php 
include __DIR__ . '/../footer.php';
?>