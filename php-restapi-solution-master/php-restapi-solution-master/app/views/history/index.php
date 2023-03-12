<?php
include __DIR__ . '/../navbar.php';

require_once 'landmarkservice.php';

$controller = new LandmarkService();

// Handle form submissions
if (isset($_POST['submit'])) {
  switch ($_POST['submit']) {
    case 'Create':
      $title = $_POST['title'];
      $description = $_POST['description'];
      $image = $_POST['image'];

      $service->createLandmark($title, $description, $image);

      break;
    case 'Update':
      $landmarkID = $_POST['landmarkID'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $image = $_POST['image'];

      $service->updateLandmark($landmarkID, $title, $description, $image);

      break;
  }
}

// Display landmarks and form
$view->displayLandmarks();
$view->displayForm();
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
  $landmarkID = $_GET['landmarkID'];
  $landmark = $service->getLandmark($landmarkID);
  if ($landmark) {
    $view->displayEditForm($landmarkID, $landmark->getTitle(), $landmark->getDescription(), $landmark->getImage());
  }
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Festival - History</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link href="../css/template.css" rel="stylesheet">
        <link href="../css/history/history.css" rel="stylesheet">
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    </head>

    <body>
        <div class="container">
            <form action="historycontroller.php" method="post"></form>
                <textarea name="historyeditor" id="historyeditor">test</textarea>

                <p>
                    <input type="submit" name="submit_data" value="submit">
                </p>
            </form>
            <script>
            ClassicEditor
            .create( document.querySelector( '#historyeditor' ) )
            .catch( error => {
                console.error( error );
            } );
            </script>
            <!-- <script>
                    CKEDITOR.replace('historyeditor');
            </script> -->

            <div class="background-Image">
            <div class="border-box">
              <div class="container" id="titleContainer">
                <h1>Haarlem History</h1>
              </div>
            </div>
            <div class="container landingPageContainer">
              <div class="row">
                <div class="col-md-7" id="titleText">
                  <h2>Learn about our <strong>artists</strong></h2>
                  <p>The Festival Jazz is a premier event. Showcasing the best in local and international jazz talent, in partnership with Haarlem Jazz, the festival’s jazz events provide a vibrant and lively atmosphere for music fans to come together and enjoy the sounds of the genre.
                    <br> <br>
                    Read below more about the artists, schedule and locations!
                  </p>
                </div>
                <div class="col-md-7">
                  <button> See Schedule <strong>↓</strong> </button>
                </div>
              </div>
            </div>
            <div class="container special">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/image/.png">
                    <h1></h1>
                  </div>
                  <div class="carousel-item">
                    <img src="/image/.png">
                  </div>
                  <div class="carousel-item">
                    <img src="/image/.png">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

              <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

            </div>
          </div>
        </div>
    <div>
      <h1>Landmarks</h1>

      <div id="landmarks-table">
        <?php $view->displayLandmarks(); ?>
      </div>

      <h2>Add Landmark</h2>

      <div id="landmark-form">
        <?php $view->displayForm(); ?>
      </div>

      <h2>Edit Landmark</h2>

      <div id="edit-landmark-form">
        <?php
          if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            $landmarkID = $_GET['landmarkID'];
            $landmark = $service->getLandmark($landmarkID);
            if ($landmark) {
              $view->displayEditForm($landmarkID, $landmark->getTitle(), $landmark->getDescription(), $landmark->getImage());
            } else {
              echo "Landmark not found";
            }
          }
        ?>
      </div>
    </div>
    </body>
</html>