<?php
include __DIR__ . '/../navbar.php';

// Handle form submissions
if (isset($_POST['submit'])) {
  switch ($_POST['submit']) {
    case 'Create':
      $title = $_POST['title'];
      $description = $_POST['description'];
      $image = $_POST['image'];

      $controller->createLandmark($title, $description, $image);

      break;
    case 'Update':
      $landmarkID = $_POST['landmarkID'];
      $title = $_POST['title'];
      $description = $_POST['description'];
      $image = $_POST['image'];

      $controller->updateLandmark($landmarkID, $title, $description, $image);

      break;
  }
}

// Display landmarks and form
$controller->displayLandmarks();
$controller->displayCreateForm();
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
  $landmarkID = $_GET['landmarkID'];
  $landmark = $controller->getLandmark($landmarkID);
  if ($landmark) {
    $controller->displayEditForm($landmarkID, $landmark->getTitle(), $landmark->getDescription(), $landmark->getImage());
  }
}
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
</head>
 
<body>
    <h1>Landmarks</h1>

    <div id="landmarks-table">
      <?php $controller->displayLandmarks(); ?>
    </div>

    <h2>Add Landmark</h2>

    <div id="landmark-form">
        <?php $controller->displayCreateForm(); ?>
    </div>

    <h2>Edit Landmark</h2>

    <div id="edit-landmark-form">
        <?php
            if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                $landmarkID = $_GET['landmarkID'];
                $landmark = $controller->getLandmark($landmarkID);

                if ($landmark) {
                    $controller->displayEditForm($landmarkID);
                    
                } else {
                    echo "Landmark not found";
                }
            }
        ?>
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
    </script>
</body>
