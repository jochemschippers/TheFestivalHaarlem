<?php
include __DIR__ . '/../navbar.php';
require_once __DIR__ . '/../../services/landmarkservice.php';

$service = new LandmarkService();

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
$service->displayLandmarks();
$service->displayCreateForm();
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
  $landmarkID = $_GET['landmarkID'];
  $landmark = $service->getLandmark($landmarkID);
  if ($landmark) {
    $service->displayEditForm($landmarkID, $landmark->getTitle(), $landmark->getDescription(), $landmark->getImage());
  }
}
?>

<!DOCTYPE html>
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
            </script>
            <div class="background-Image-History">
            <div class="border-box">
              <div class="container" id="titleContainer">
                <h1>A stroll through history</h1>
              </div>
            </div>
            <div class="container landingPageContainer">
              <div class="row">
                <div class="col-md-7" id="titleText">
                    <h2><strong>Visit</strong> all the historic sights of Haarlem</h2>
                    <p>The historical inner city of Haarlem features lots of extraordinary monuments. 
                    Discover the many interesting and surprising monuments that this city makes unique through this tour. 
                    Our guides will take you along several monuments in the city of Haarlem as you can see below.
                    </p>
                    <p>
                    <h4><strong>Check out our Schedule</strong></h4>
                    </p>
                </div>
                <div class="col-md-7">
                  <button><strong>↓</strong></button>
                </div>
              </div>
            </div>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe
                class="embed-responsive-item"
                src="https://www.google.com/maps/d/u/0/embed?mid=1xMakWcCkWRc-eW4IGAR_zDG1UttbB1k&ehbc=2E312F"
                title="Landmark Route">
                </iframe>
            </div>
            <div class="container special">
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            </div>
          </div>
        </div>
        <div class="">
        <h1>Landmarks</h1>

         <div id="landmarks-table">
          <?php $service->displayLandmarks(); ?>
        </div>

        <h2>Add Landmark</h2>

        <div id="landmark-form">
            <?php $service->displayCreateForm(); ?>
        </div>

        <h2>Edit Landmark</h2>

        <div id="edit-landmark-form">
        <?php
          if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            $landmarkID = $_GET['landmarkID'];
            $landmark = $service->getLandmark($landmarkID);
            if ($landmark) {
              $service->displayEditForm($landmarkID, $landmark->getTitle(), $landmark->getDescription(), $landmark->getImage());
            } else {
              echo "Landmark not found";
            }
          }
        ?>
        </div>
        </div>
        <form action="historycontroller.php" method="post"></form>
        <textarea name="historyeditor" id="historyeditor">
            <p>This is some sample content.</p>
            </textarea>
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
    </body>
</html>