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
// $controller->displayLandmarks();
// $controller->displayCreateForm();
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
        <?php //$controller->displayLandmarks();
            // foreach ($model as $landmark) 
            // {
            //     echo "<div class='col-md-4'>";
            //     echo "<div class='card mb-4 shadow-sm'>";
            //     echo "<img class='card-img-top' src='images/" . $landmark->getImage() . "' alt='Card image cap'>";
            //     echo "<div class='card-body'>";
            //     echo "<h5 class='card-title'>" . $landmark->getTitle() . "</h5>";
            //     echo "<p class='card-text'>" . $landmark->getDescription() . "</p>";
            //     echo "<div class='d-flex justify-content-between align-items-center'>";
            //     echo "<div class='btn-group'>";
            //     echo "<a href='index.php?controller=landmark&action=edit&landmarkID=" . $landmark->getLandmarkID() . "' class='btn btn-sm btn-outline-secondary'>Edit</a>";
            //     echo "<a href='index.php?controller=landmark&action=delete&landmarkID=" . $landmark->getLandmarkID() . "' class='btn btn-sm btn-outline-secondary'>Delete</a>";
            //     echo "</div>";
            //     echo "</div>";
            //     echo "</div>";
            //     echo "</div>";
            //     }
        ?>
    
        <?php
        foreach ($model as $landmark)
        {
            echo "<h2>" . $landmark->getTitle() . "</h2>";
            echo "<p>" . $landmark->getDescription() . "</p>";
            echo "<p>" . $landmark->getImage() . "</p>";
            // echo "<img src='images/" . $landmark->getImage() . "' alt='Landmark image'>";
        }
        ?>
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
                    //$controller->displayEditForm($landmarkID);
                    echo "<form action='index.php?controller=landmark&action=update' method='post' enctype='multipart/form-data'>";
                    echo "<div class='mb-3'>";
                    echo "<label for='title'>Title</label>";
                    echo "<input type='text' class='form-control' id='title' name='title' value='" . $landmark->getTitle() . "'>";
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='description'>Description</label>";
                    echo "<input type='text' id='description' name='description' value='" . $landmark->getDescription() . "'>";
                    echo "</div>";
                    echo "<div class='mb-3'>";
                    echo "<label for='image'>Image</label>";
                    echo "<input type='text' id='image' name='image'>";
                    echo "</div>";
                    echo "<input type='text' name='landmarkID' value='" . $landmark->getLandmarkID() . "'>";
                    echo "<button type='submit' class='btn btn-primary'>Update</button>";
                    echo "</form>";
                    
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
